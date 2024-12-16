<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$inputan = $this->input->post();

		//form validation username dan passwrod wajib di isi
		$this->form_validation->set_rules("Email_User", "Email_User", "required");
		$this->form_validation->set_rules("Password", "Password", "required");

		//atur pesan dalam b.indo
		$this->form_validation->set_message("required", "%s wajib diisi");

		if($this->form_validation->run()==TRUE ){
			$this->load->model('admin/Madmin');
			$output = $this->Madmin->login($inputan);

			if ($output=="ada"){
		 		$this->session->set_flashdata('pesan_sukses', 'Berhasil Login');
				redirect('admin/home', 'refresh');
			}else{
				$this->session->set_flashdata('pesan_gagal', 'Gagal Login');
				redirect('welcome', 'refresh');
			}
		}
		$this->load->view('auth/login');
	}
}
