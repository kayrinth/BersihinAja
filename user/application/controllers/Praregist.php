<?php
class Praregist extends CI_Controller
{

    function index()
    {

        $this->load->view('header');
        $this->load->view('praregist');
        $this->load->view('footer');
        $this->load->helper('url');
    }
}
