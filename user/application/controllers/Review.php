<?php
class Review extends CI_Controller
{

    function index()
    {

        $this->load->view('header');
        $this->load->view('review');
        $this->load->view('footer');
        $this->load->helper('url');
    }
}
