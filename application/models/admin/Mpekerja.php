<?php 
class Mpekerja extends CI_Model{
	function tampil(){
		//melakukan query
		$q = $this->db->get("user");
		$d = $q->result_array();
		
		return $d;
	}
	function detail($id_user): mixed {
		$this->db->where('Id_User', $id_user);
	
		// Melakukan query
		$q = $this->db->get("user");
	
		// Periksa apakah data ditemukan
		if ($q->num_rows() > 0) {
			return $q->row_array(); // Mengembalikan baris tunggal
		}
	
		return null; // Jika tidak ditemukan, kembalikan null
	}

}
?>
