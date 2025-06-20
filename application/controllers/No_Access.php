<?php
defined('BASEPATH') or exit('No direct script access allowed');

class No_Access extends CI_Controller
{
    public function index()
    {
        // Display the access denied error page
        $data['message'] = $this->session->flashdata('error') ?? 'You do not have permission to access this page. Please log out and use a different user account.';
        $this->load->view('error/header');
        $this->load->view('error/no_access', $data);
        $this->load->view('error/footer');
    }
}
