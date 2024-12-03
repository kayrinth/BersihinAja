<?php
class Mcustomer extends CI_Model
{
    function tampilCustomer()
    {
		//melakukan query
		$q = $this->db->get("user");
		$d = $q->result_array();
		
		return $d;
    }

    function detail($id_user): mixed {
        $this->db->where('Id_User', $id_user);
    
        // Melakukan query
        $q = $this->db->get("user");
    
        // Mengambil baris pertama (satu data)
        $d = $q->row_array();
    
        return $d;
    }

}
