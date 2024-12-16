<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller{

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
            redirect('no_access', 'refresh');
        }
	}

	public function index()
	{
		$inputan = $this->input->post();

		//pasang form_validation
		$this->form_validation->set_rules("Email_user", "Email_user", "required");
		$this->form_validation->set_rules("Nama_User", "Nama Lengkap", "required");

		//atur pesan dalam b.indo
		$this->form_validation->set_message("required", "%s wajib diisi");

		if ($this->form_validation->run()==TRUE ){
			//jalankan skrip ubah
			$this->load->model('admin/Madmin');
			$id_admin = $this->session->userdata("id_admin");
			$this->Madmin->ubah($inputan, $id_admin);


			$this->session->set_flashdata('pesan_sukses', 'Akun telah diubah');
			redirect('home', 'refresh');
		}

		$this->load->view("admin/header");
		$this->load->view("admin/akun");
		$this->load->view("admin/footer");
	}
}
?>
