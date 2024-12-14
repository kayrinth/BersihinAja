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
    // Ambil data dari sesi dan POST
    $id_user = $this->session->userdata('id_user'); // ID pengguna dari sesi
    $id_services = $this->input->post('id_services'); // ID layanan
    $selected_paket = $this->input->post('paket'); // Paket yang dipilih
    $selected_pekerja = $this->input->post('selected_pekerja'); // Pekerja yang dipilih
    $alamat_order = $this->input->post('alamat'); // Alamat pengiriman
    $tanggal_order = date('Y-m-d H:i:s'); // Tanggal order

    // Ambil detail layanan
    $detail_layanan = $this->Mservice_detail->getServiceDetail($id_services);

    // Hitung total harga
    $total_harga = (int)$detail_layanan['Harga']; // Harga layanan
    if (!empty($selected_paket)) {
        foreach ($selected_paket as $id_paket) {
            $paket = $this->Mservice_detail->getPackageById($id_paket);
            $total_harga += (int)$paket['Harga']; // Tambahkan harga paket
        }
    }

    // Status pembayaran (default: belum dibayar)
    $status_pembayaran = 'Belum Dibayar';

    // Siapkan data untuk dimasukkan ke tabel detail_pemesanan
    $data_pemesanan = [
        'Id_Jenis_Layanan' => $id_services,
        'Id_Pemesanan' => NULL, // Akan diisi ID pemesanan dari tabel pemesanan utama (jika ada relasi)
        'Total' => $total_harga,
        'Status_Pembayaran' => $status_pembayaran,
        'Alamat' => $alamat_order,
        'Tanggal_Order' => $tanggal_order,
        'Ulasan' => NULL, // Default kosong
        'Jumlah_Rating' => NULL, // Default kosong
        'Id_Paket' => !empty($selected_paket) ? implode(',', $selected_paket) : NULL,
        'Id_User' => $id_user // ID pengguna yang membuat order
    ];

    // Simpan ke database
    $this->load->model('Mpemesanan'); // Load model untuk pemesanan
    $insert_id = $this->Mpemesanan->saveDetailPemesanan($data_pemesanan);

    if ($insert_id) {
        // Simpan relasi pekerja ke tabel tambahan jika diperlukan
        // if (!empty($selected_pekerja)) {
        //     foreach ($selected_pekerja as $id_pekerja) {
        //         $data_pekerja = [
        //             'Id_Detail_Pemesanan' => $insert_id,
        //             'Id_User' => $id_pekerja
        //         ];
        //         $this->Mpemesanan->savePemesananPekerja($data_pekerja);
        //     }
        // }

        $this->session->set_flashdata('success', 'Pemesanan berhasil disimpan!');
        redirect('services'); // Redirect ke halaman layanan
    } else {
        $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan pemesanan.');
        redirect('nota_pemesanan');
    }
}


    
}