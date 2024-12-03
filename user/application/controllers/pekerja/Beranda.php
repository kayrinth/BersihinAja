<?php
class Beranda extends CI_Controller
{

    function index()
    {
        // Nonaktifkan cache
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $this->load->view('pekerja/header');
        $this->load->view('pekerja/beranda');
        $this->load->helper('url');
    }
}
