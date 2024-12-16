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

        $this->load->view('header');
        $this->load->view('service_detail', $data);
        $this->load->view('footer');
    }
}
