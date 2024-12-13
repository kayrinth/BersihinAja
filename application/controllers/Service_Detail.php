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

}
