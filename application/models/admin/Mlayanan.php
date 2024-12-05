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

	function edit($inputan, $id_services){
		//ngurusi foto_layanan jika user upload foto

		$config['upload_path'] = $this->config->item("assets_layanan");
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$this->load->library("upload", $config); 

		//adegan ngupload
		$ngupload = $this->upload->do_upload("Foto_Layanan");

		//jika ngupload
		if ($ngupload){
			$inputan['Foto_Layanan'] = $this->upload->data("file_name");
		}

		//query update data sesuai id_layanan
		$this->db->where('Id_Services', $id_services);
		$this->db->update('jenis_layanan', $inputan);
	}
}
?>
