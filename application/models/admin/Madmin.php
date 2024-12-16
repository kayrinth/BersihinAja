<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Madmin extends CI_Model{
	function login($inputan){
		$username = $inputan['Email_User'];
		$password = $inputan['Password'];
		$password = sha1($password);

		//cek ke database
		$this->db->where('Email_User', $username);
		$this->db->where('Password', $password);
		$q = $this->db->get('user');
		$cekadmin = $q->row_array();

		//jika tidak kosong, maka ada
		if (!empty($cekadmin)){
			//membuat tiket bioskop yang dipakai selama keliling aplikasi
			$this->session->set_userdata("Id_User", $cekadmin["Id_User"]);
			$this->session->set_userdata("Email_User", $cekadmin["Email_User"]);
			$this->session->set_userdata("Nama_User", $cekadmin["Nama_User"]);
			return "ada";
		} else {
			return "gak ada";
		}
	}
	

	function ubah($inputan, $id_admin){

		//jika  paswword tidak kosong, maka enkripsi
		if (!empty($inputan["Password"])){
			$inputan['Password'] = sha1($inputan['Password']);
		} else{
			unset($inputan['Password']);
		}

		$this->db->where('Id_User', $id_admin);
		$this->db->update('user', $inputan);

		//karena akun admin telah diubah pada database, maka tiket bioskopnya jg harus membuat baru

		//dapatkan dulu data admin yang baru yang telah diupdate
		$this->db->where('Id_User', $id_admin);
		$q = $this->db->get('user');
		$cekadmin = $q->row_array();
		//buat tiket lagi
		$this->session->set_userdata("Id_User", $cekadmin["Id_User"]);
		$this->session->set_userdata("Email_User", $cekadmin["Email_User"]);
		$this->session->set_userdata("Nama_User", $cekadmin["Nama_User"]);
	}
}
?>
