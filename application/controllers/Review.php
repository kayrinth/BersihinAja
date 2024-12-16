<?php
class Review extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

    function index()
    {

        $this->load->view('header');
        $this->load->view('review');
        $this->load->view('footer');
        $this->load->helper('url');
    }
}
