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
        $this->session->set_userdata('id_user', $user_data['Id_User']);


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
        $id_user = $this->session->userdata('id_user'); // ID pelanggan yang login
        $user_data = $this->Muser->getUserById($id_user); // Ambil data pelanggan
        // Ambil data dari formulir
        $selected_paket = $this->input->post('paket');
        $selected_pekerja = $this->input->post('selected_pekerja');
        $id_services = $this->input->post('id_services');

        $detail_layanan = $this->Mservice_detail->getServiceDetail($id_services);
    
        // Validasi minimal satu pekerja dipilih
        if (empty($selected_pekerja)) {
            $this->session->set_flashdata('error', 'Anda wajib memilih minimal satu pekerja!');
            redirect('service_detail?id=' . $id_services);
            return;
        }
    
        // Lanjutkan proses jika validasi terpenuhi...
        $maxSelection = 0;
        switch ($id_services) {
            case 1:
                $maxSelection = 1; // ID layanan 1: Maksimal 1 pekerja
                break;
            case 2:
                $maxSelection = 3; // ID layanan 2: Maksimal 3 pekerja
                break;
            default:
                $maxSelection = PHP_INT_MAX; // Tidak ada batas
        }
    
        if (count($selected_pekerja) > $maxSelection) {
            $this->session->set_flashdata(
                'error',
                "Maksimal hanya $maxSelection pekerja yang dapat dipilih untuk layanan ini."
            );
            redirect('service_detail?id=' . $id_services);
            return;
        }

        $paket_detail = [];
        if (!empty($selected_paket)) {
            foreach ($selected_paket as $id_paket) {
                $paket_detail[] = $this->Mservice_detail->getPackageById($id_paket);
            }
        }

        $pekerja_detail = [];
        if (!empty($selected_pekerja)) {
            foreach ($selected_pekerja as $id_pekerja) {
                $pekerja_detail[] = $this->Muser->getUserById($id_pekerja);
            }
        }

        // Siapkan data untuk ditampilkan di nota
        $data['user_data'] = $user_data; // Tambahkan data pelanggan
        $data['detail_layanan'] = $detail_layanan;
        $data['paket_detail'] = $paket_detail;
        $data['pekerja_detail'] = $pekerja_detail;

        // Load tampilan nota
        $this->load->view('header');
        $this->load->view('nota_pemesanan', $data);
        $this->load->view('footer');
    }
    public function saveOrder()
    {
        
        $id_customer = $this->session->userdata('id_user'); // Ambil ID pengguna yang memesan
        $id_services = $this->input->post('id_services'); // ID layanan
        $selected_paket = $this->input->post('paket'); // Paket yang dipilih
        $selected_pekerja = $this->input->post('selected_pekerja'); // Pekerja yang dipilih
    
        $alamat = $this->input->post('alamat'); // Alamat pemesan
        $tanggal_order = date('Y-m-d H:i:s'); // Waktu pemesanan
        $status_pembayaran = 'Belum Dibayar'; // Default status pembayaran
    
        // Hitung total harga
        $total_harga = 0;
    
        // Ambil detail layanan untuk menghitung total
        $detail_layanan = $this->Mservice_detail->getServiceDetail($id_services);
        if ($detail_layanan) {
            $total_harga += $detail_layanan['Harga'];
        }
    
        // Ambil detail paket yang dipilih
        if (!empty($selected_paket)) {
            foreach ($selected_paket as $id_paket) {
                $paket = $this->Mservice_detail->getPackageById($id_paket);
                if ($paket) {
                    $total_harga += $paket['Harga'];
                }
            }
        }
    
        // Siapkan data untuk disimpan di tabel detail_pemesanan
        $data = [
            'Id_Jenis_Layanan' => $id_services,
            'Total' => $total_harga,
            'Status_Pembayaran' => $status_pembayaran,
            'Alamat' => $alamat,
            'Tanggal_Order' => $tanggal_order,
            'Id_Paket' => !empty($selected_paket) ? implode(',', $selected_paket) : null, // Simpan dalam bentuk string jika banyak paket
            'Id_Pekerja' => !empty($selected_pekerja) ? implode(',', $selected_pekerja) : null, // Simpan pekerja dalam bentuk string
            'Id_Customer' => $id_customer, // Tambahkan ID pelanggan
            'Ulasan' => null, // Belum ada ulasan
            'Jumlah_Rating' => null, // Belum ada rating
        ];
    
        // Simpan data ke tabel detail_pemesanan
        $this->db->insert('detail_pemesanan', $data);
    
        // Redirect ke halaman konfirmasi atau detail pemesanan
        $this->session->set_flashdata('success', 'Pesanan berhasil dibuat!');
        redirect('services');
    }
    
}