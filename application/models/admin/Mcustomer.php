<?php 
class Mcustomer extends CI_Model{
	function tampil(){
		//melakukan query
		$q = $this->db->get("user");
		$d = $q->result_array();
		
		return $d;
	}
	function detail($id_user): mixed {
		$this->db->where('Id_User', $id_user);
		$q = $this->db->get("user");
	
		if ($q->num_rows() == 0) {
			log_message('error', "Customer with ID {$id_user} not found.");
			return null;
		}
	
		return $q->row_array(); // Ubah ke row_array jika hanya ingin satu baris
	}

}
?>
