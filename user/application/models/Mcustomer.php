<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcustomer extends CI_Model
{
    public function getCustomerById($id_customer)
    {
        return $this->db->get_where('customer', ['Id_Customer' => $id_customer])->row_array();
    }

    public function updateCustomer($id_customer, $data)
    {
        $this->db->where('Id_Customer', $id_customer);
        $this->db->update('customer', $data);
    }

    function tampil()
    {

        //melakukan query
        $q = $this->db->get("customer");

        //pecah ke array
        $d = $q->result_array();

        return $d;
    }
}
