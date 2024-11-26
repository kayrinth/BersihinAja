<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		if (!$this->session->userdata('email_customer')) {
			redirect('auth');
		}

		$data['user'] = $this->db->get_where('customer', ['Email_Customer' => $this->session->userdata('email_customer')])->row_array();


		$this->load->view('header');
		$this->load->view('home', $data);
		$this->load->view('footer');
	}
}
