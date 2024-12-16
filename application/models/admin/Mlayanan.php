<?php 
class Mlayanan extends CI_Model{
	function tampil(){

		//melakukan query
		$q = $this->db->get("jenis_layanan");

		// pecah ke array
		$d = $q->result_array();
		
		return $d;
	}

	function simpan($inputan){
		//kita urusi dulu upload foto_layanan
		$config['upload_path'] = $this->config->item("assets_layanan");
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		
		$this->load->library('upload', $config);

		//adegan ngupload foto_layanan
		$ngupload = $this->upload->do_upload("Foto_Layanan");

		//jika ngupload, maka dapatkan nama fotoyna untuk ditampung ke db
		if ($ngupload){
			log_message('error', $this->upload->display_errors());
			$inputan['Foto_Layanan'] = $this->upload->data("file_name");
		}

		//query simpan data ke tabel layanan
		//insert into layanan bla bla bla
		$this->db->insert('jenis_layanan', $inputan);
	}
	
	function hapus($id_services){
		//delete from layanan where id_layanan=5
		$this->db->where('Id_Services', $id_services);
		$this->db->delete('jenis_layanan');

	}

	function detail($id_services){
		//select * from layanan where id_layanan=4
		$this->db->where('Id_Services', $id_services);
		$q = $this->db->get('jenis_layanan');
		$d = $q->row_array();

		return $d;
	}

	function edit($inputan, $id_services) {
		// Konfigurasi upload
		$config['upload_path'] = $this->config->item("assets_layanan");
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$this->load->library("upload", $config);

		// Adegan ngupload
		$ngupload = $this->upload->do_upload("Foto_Layanan");

		if ($ngupload) {
			// Jika berhasil upload, tambahkan nama file ke $inputan
			$inputan['Foto_Layanan'] = $this->upload->data("file_name");
			log_message('info', "Upload berhasil, file: " . $inputan['Foto_Layanan']);
		} else {
			// Log error jika gagal upload
			$error = $this->upload->display_errors();
			log_message('error', "Upload error: " . $error);

			// Kirim pesan error ke session
			$this->session->set_flashdata('error', 'Gagal mengunggah foto: ' . strip_tags($error));
		}

		// Log data sebelum update
		log_message('info', "Data yang akan diupdate untuk ID: $id_services - " . print_r($inputan, true));

		// Query update data sesuai id_services
		$this->db->where('Id_Services', $id_services);
		$this->db->update('jenis_layanan', $inputan);

		// Log hasil update
		if ($this->db->affected_rows() > 0) {
			log_message('info', "Data berhasil diupdate untuk ID: $id_services");
		} else {
			log_message('error', "Data gagal diupdate untuk ID: $id_services");
		}
	}

}
?>
