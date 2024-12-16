<?php
defined('BASEPATH') or exit('No direct script access allowed');

class No_Access extends CI_Controller
{
    public function index()
    {
        // Tampilkan halaman error akses ditolak
        $data['message'] = $this->session->flashdata('error') ?? 'Anda tidak memiliki izin untuk mengakses halaman ini, silahkan log-out dan gunakan user lain.';
        $this->load->view('error/header');
        $this->load->view('error/no_access', $data);
        $this->load->view('error/footer');
    }
}