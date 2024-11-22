<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Pekerja extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('register_pekerja');
		
		
	}
}
