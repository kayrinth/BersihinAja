<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcustomer extends CI_Model
{
    function login($inputan)
    {
        $email = $inputan['email'];
        $password = $inputan['password'];
        $password = sha1($password);

        //cek database
        $this->db->where('email_customer', $email);
        $this->db->where('password', $password);
        $q = $this->db->get('customer');
        $cekcus = $q->row_array();

        //jika tidak kosong maka ada
        if (!empty($cekcus)) {

            $this->session->set_userdata("id_customer", $cekcus["id_customer"]);
            $this->session->set_userdata("username", $cekcus["username"]);
            return "ada";
        } else {
            return "gak ada";
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register($data)
    {

        return $this->db->insert('customer', $data);
    }
}
