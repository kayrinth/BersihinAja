<?php
class Mcustomer extends CI_Model
{
    function tampilCustomer()
    {
        $this->db->select('Id_User, Nama_User, Email_User, No_Hp');
        $this->db->from('user');
        $this->db->where('Role_Id', 'customer'); // Hanya customer
        return $this->db->get()->result_array();
    }
}
