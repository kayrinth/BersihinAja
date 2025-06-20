<?php 
class Layanan extends CI_Controller{


	function __construct()
	{
		parent::__construct();

        // Periksa apakah user sudah login
        if (!$this->session->userdata("id_user")) {
            redirect('auth', 'refresh');
        }

        // Periksa apakah Role_Id user adalah admin
        if ($this->session->userdata("role_id") !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            redirect('/', 'refresh');
        }
	}

	function index(){



		//panggil model Mlayanan
		$this->load->model("admin/Mlayanan");

		$data["jenis_layanan"] = $this->Mlayanan->tampil();

		$this->load->view("admin/header");
		$this->load->view("admin/layanan_tampil", $data);
		$this->load->view("admin/footer");
	}
	function tambah(){

		//mendapatkan inputan dari forumulir pakai $this->input->post()
		$inputan = $this->input->post();

		//pasang form_validation
		$this->form_validation->set_rules("Nama_Layanan", "Nama Layanan", "required");

		//atur pesan dalam b.indo
		$this->form_validation->set_message("required", "%s wajib diisi");

		//jika ada inputan
		if ($this->form_validation->run()==TRUE ){
			//panggil model Mlayanan
			$this->load->model('admin/Mlayanan');

			//jalankan fungsi simpan ()
			$this->Mlayanan->simpan($inputan);

			//pesan dilayar
			$this->session->set_flashdata('pesan_sukses', 'Data layanan tersimpan');

			//redirect ke fitur layanan utk tampil layanan
			redirect('admin/layanan','refresh');
		}

		$this->load->view("admin/header");
		$this->load->view("admin/layanan_tambah");
		$this->load->view("admin/footer");
	}

	function hapus($id_services){
		echo $id_services;

		//panggil model Mlayanan
		$this->load->model('admin/Mlayanan');

		//jalankan fungsi hapus();
		$this->Mlayanan->hapus($id_services);

		//pesan di layar
		$this->session->set_flashdata('pesan_sukses', 'layanan telah hapus');

		//redirect ke layanan utk tampil data
		redirect('admin/layanan', 'refresh');
	}

	function edit($id_services){


		//1. Tmapilkan dulu layanan yang lama
		$this->load->model("admin/Mlayanan");
		$data['jenis_layanan'] = $this->Mlayanan->detail($id_services);

		//2. baru mikir ngubah data
		$inputan = $this->input->post();

		//pasang form_validation
		$this->form_validation->set_rules("Nama_Layanan", "Nama Layanan", "required");

		//atur pesan dalam b.indo
		$this->form_validation->set_message("required", "%s wajib diisi");

		//jk adad inputan
		if ($this->form_validation->run()==TRUE ){
			//jalankan fungsi edit()
			$this->Mlayanan->edit($inputan, $id_services);

			//pesan
			$this->session->set_flashdata('pesan_sukses', 'layanan telah diubah');

			//redirect
			redirect('admin/layanan', 'refresh');
		}



		$this->load->view("admin/header");
		$this->load->view("admin/layanan_edit", $data);
		$this->load->view("admin/footer");
	}
}
?>
