<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['user'] = null;
		if ($this->session->userdata('Email_User')) {
			$data['user'] = $this->db->get_where('user', ['Email_User' => $this->session->userdata('Email_User')])->row_array();
		}

		$this->load->model("Muser");
		$data['user'] = $this->Muser->tampilPekerja();

		// Render halaman home
		$this->load->view('header');
		$this->load->view('customer/home', $data);
		$this->load->view('footer');
	}
}