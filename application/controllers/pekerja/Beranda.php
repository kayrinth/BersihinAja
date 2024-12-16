<?php
class Beranda extends CI_Controller
{

    function __construct()
	{
		parent::__construct();

        // Periksa apakah user sudah login
        if (!$this->session->userdata("id_user")) {
            redirect('auth', 'refresh');
        }

        // Periksa apakah Role_Id user adalah admin
        if ($this->session->userdata("role_id") !== 'pekerja') {
            $this->session->set_flashdata('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            redirect('no_access', 'refresh');
        }
	}

    function index()
    {
        // Nonaktifkan cache
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $this->load->view('pekerja/header');
        $this->load->view('pekerja/beranda');
        $this->load->helper('url');
    }
}
