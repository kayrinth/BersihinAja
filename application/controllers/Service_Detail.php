<?php
class Service_Detail extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Mservice_detail'); // Memuat model khusus service_detail
    }

    public function index()
    {
        // Tangkap parameter id dari query string
        $id_services = $this->input->get('id');

        // Validasi apakah ID tersedia
        if (!$id_services) {
            $this->session->set_flashdata('error', 'ID layanan tidak disediakan.');
            redirect('services'); // Kembali ke halaman layanan
        }

        // Ambil detail layanan berdasarkan ID menggunakan model
        $data['detail_layanan'] = $this->Mservice_detail->getServiceDetail($id_services);

        // Pastikan data ditemukan, jika tidak redirect atau tampilkan error
        if (empty($data['detail_layanan'])) {
            $this->session->set_flashdata('error', 'Layanan tidak ditemukan.');
            redirect('services'); // Kembali ke halaman layanan
        }

        // Load header, service_detail view, dan footer
        $this->load->view('header');
        $this->load->view('service_detail', $data); // Kirim data ke view
        $this->load->view('footer');
    }
}
