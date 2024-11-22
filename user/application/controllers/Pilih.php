<?php 
class Pilih extends CI_Controller {

	function index() {

		$this->load->view('pilih');	
		$this->load->helper('url');
		$this->load->view('footer');

	}
}
 ?>