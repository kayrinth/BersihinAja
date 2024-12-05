<?php
class Transaksi extends CI_Controller
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

        // Load model
        //$this->load->model("Mtransaksi");

        // Ambil data transaksi
        //$data["transaksi"] = $this->Mtransaksi->tampil();

        $this->load->view('pekerja/header');
        $this->load->view('pekerja/transaksi');
        $this->load->helper('url');
    }
}
