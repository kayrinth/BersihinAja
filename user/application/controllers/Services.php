<?php 
class Services extends CI_Controller {

	function index() {

		$this->load->view('header');
        $this->load->view('services');	
		$this->load->view('footer');
		$this->load->helper('url');

	}
}
 ?>