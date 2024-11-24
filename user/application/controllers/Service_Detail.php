<?php 
class Service_Detail extends CI_Controller {

	function index() {

		$this->load->view('header');
        $this->load->view('service_detail');	
		$this->load->view('footer');
		$this->load->helper('url');

	}
    
}
 ?>