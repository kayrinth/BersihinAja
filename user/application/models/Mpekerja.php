<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mpekerja extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register($data)
    {
        return $this->db->insert('pekerja', $data);
    }
}
