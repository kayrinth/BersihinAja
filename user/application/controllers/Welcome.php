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
		if ($this->session->userdata('email_customer')) {
			$data['user'] = $this->db->get_where('customer', ['Email_Customer' => $this->session->userdata('email_customer')])->row_array();
		}

		// Render halaman home
		$this->load->view('header');
		$this->load->view('customer/home');
		$this->load->view('footer');
	}
}
