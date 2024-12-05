<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    function __construct()
	{
		parent::__construct();

        // Periksa apakah user sudah login
        if (!$this->session->userdata("id_user")) {
            redirect('auth', 'refresh');
        }

        // Periksa apakah Role_Id user adalah pekerja
        if ($this->session->userdata("role_id") !== 'pekerja') {
            $this->session->set_flashdata('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            redirect('no_access', 'refresh');
        }
	}
	function index(){

		//panggil model Mcustomer
		$this->load->model("pekerja/Mcustomer");

		$data["customer"] = $this->Mcustomer->tampil();

		$this->load->view("pekerja/header");
		$this->load->view("pekerja/customer", $data);
	}

	function detail($id_customer) {
		$this->load->model('pekerja/Mcustomer');
		$data["customer"] = $this->Mcustomer->detail($id_customer);
	
		if (empty($data["customer"])) {
			show_404(); // Tampilkan halaman 404 jika data tidak ditemukan
			return;
		}
		// $this->load->model('Mtransaksi');
		// $data['jual'] = $this->Mtransaksi->transaksi_member_jual($id_customer);
		// $data['beli'] = $this->Mtransaksi->transaksi_member_beli($id_customer);

		$this->load->view('pekerja/header');
		$this->load->view('pekerja/customer_detail', $data);
	}
}
