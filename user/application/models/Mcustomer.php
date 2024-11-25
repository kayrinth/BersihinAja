<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcustomer extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database
    }

    public function register($data)
    {
        // Simpan data ke tabel customer
        return $this->db->insert('customer', $data);
    }
}
