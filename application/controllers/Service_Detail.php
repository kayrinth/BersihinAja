<?php
class Service_Detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Mservice_detail');
        $this->load->model('Muser');
    }

    public function index()
    {

        $id_services = $this->input->get('id');

        $id_user = $this->session->userdata('id_user');

        $user_data = $this->Muser->getuserById($id_user);

        if ($user_data) {
            $data['pekerja'] = $this->Muser->getPekerjaByAlamat($user_data['Alamat_User']);
        } else {
            $data['pekerja'] = [];
        }
        $data['detail_layanan'] = $this->Mservice_detail->getServiceDetail($id_services);

        if (empty($data['detail_layanan'])) {
            $this->session->set_flashdata('error', 'Layanan tidak ditemukan.');
            redirect('services');
        }

        // Ambil semua data paket
        $data['paket'] = $this->Mservice_detail->getAllPackages();

        $this->load->view('header');
        $this->load->view('service_detail', $data);
        $this->load->view('footer');
    }

    public function order()
    {
        // Ambil data dari formulir
        $selected_paket = $this->input->post('paket');
        $selected_pekerja = $this->input->post('selected_pekerja');
        $id_services = $this->input->post('id_services');
        $id_user = $this->session->userdata('id_user');

        if (empty($paket)) {
            // Jika tidak ada paket dipilih
            $paket = []; // Inisialisasi sebagai array kosong
        }


        // Validasi jumlah pekerja berdasarkan ID layanan
        $maxSelection = 0;
        switch ($id_services) {
            case 1:
                $maxSelection = 1;
                break;
            case 2:
                $maxSelection = 3;
                break;
            default:
                $maxSelection = PHP_INT_MAX;
                break;
        }

        if (count($selected_pekerja) > $maxSelection) {
            $this->session->set_flashdata('error', "Maksimal hanya $maxSelection pekerja yang dapat dipilih.");
            redirect('service_detail?id=' . $id_services);
            return;
        }

        // Looping untuk menyimpan data ke database (tabel paket_pemesanan)
        if (!empty($selected_paket)) {
            foreach ($selected_paket as $id_paket) {
                $paket_data = [
                    'Id_Services' => $id_services,
                    'Id_Paket' => $id_paket,
                    'Id_User' => $id_user // Tambahkan ID Customer
                ];

                // Simpan data ke database lewat model
                $this->Mservice_detail->insertPaketPemesanan($paket_data);
            }
        }

        // Redirect dengan pesan sukses
        $this->session->set_flashdata('success', 'Pemesanan berhasil!');
        redirect('service_detail?id=' . $id_services);
    }


    public function saveOrder()
    {
        // Ambil data dari form
        $id_services = $this->input->post('id_services');
        $selected_paket = $this->input->post('paket');
        $selected_pekerja = $this->input->post('selected_pekerja');
        $alamat = $this->input->post('alamat');
        $id_user = $this->session->userdata('id_user');

        // Ambil detail layanan
        $detail_layanan = $this->Mservice_detail->getServiceDetail($id_services);

        // Hitung total harga
        $total_harga = $detail_layanan['Harga'];
        if (!empty($selected_paket)) {
            $paket_harga = array_sum(array_map(function ($id_paket) {
                $paket = $this->Mservice_detail->getPackageById($id_paket);
                return $paket['Harga'];
            }, $selected_paket));
            $total_harga += $paket_harga;
        }

        $order_data = [
            'Id_Jenis_Layanan' => $id_services,
            'Id_Pemesanan' => $id_user,
            'Total' => $total_harga,
            'Status_Pembayaran' => 'Pending',
            'Alamat' => $alamat,
            'Tanggal_Order' => date('Y-m-d H:i:s'),
            'Ulasan' => null,
            'Jumlah_Rating' => null,
        ];

        // Simpan ke database
        $order_id = $this->Mservice_detail->saveOrder($order_data);

        if ($order_id) {
            $this->session->set_flashdata('success', 'Pesanan berhasil disimpan.');
            redirect('services');
        } else {
            $this->session->set_flashdata('error', 'Pesanan gagal disimpan.');
            redirect('service_detail?id=' . $id_services);
        }
    }
}
