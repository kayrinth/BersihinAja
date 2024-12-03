<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pekerja/Mcustomer');
        $this->load->library('session');
    }

    public function index()
    {
        $data['user'] = $this->Mcustomer->tampilCustomer(); // Ambil data customer
        $this->load->view('pekerja/header', $data); // Load view
        $this->load->view('pekerja/customer', $data); // Load view
    }
}
