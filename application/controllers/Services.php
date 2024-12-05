<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->model("Mservices");
		$data['services'] = $this->Mservices->tampilServices();

		$this->load->view('header');
		$this->load->view('services', $data);
		$this->load->view('footer');
	}
}
