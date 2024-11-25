<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_Customer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation'); // Load library form_validation
		$this->load->model('Mcustomer'); // Load model Mcustomer
	}

	public function index()
	{
		// Validasi form
		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("email_customer", "Email", "required|valid_email|is_unique[customer.Email_Customer]");
		$this->form_validation->set_rules("alamat_customer", "Alamat", "required");
		$this->form_validation->set_rules("No_Hp", "No Telepon", "required|numeric");
		$this->form_validation->set_rules("password", "Password", "required|min_length[6]");

		// Custom pesan error
		$this->form_validation->set_message("required", "%s wajib diisi");
		$this->form_validation->set_message("is_unique", "%s sudah digunakan");
		$this->form_validation->set_message("valid_email", "%s tidak valid");
		$this->form_validation->set_message("min_length", "%s minimal 6 karakter");
		$this->form_validation->set_message("numeric", "%s harus berupa angka");

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register_customer');
		} else {
			$data = [
				'Username' => $this->input->post('username'),
				'Email_Customer' => $this->input->post('email_customer'),
				'Alamat_Customer' => $this->input->post('alamat_customer'),
				'No_Hp' => $this->input->post('No_Hp'),
				'Password' => sha1($this->input->post('password'))
			];

			// Simpan data ke database
			if ($this->Mcustomer->register($data)) {
				$this->session->set_flashdata('pesan_sukses', 'Registrasi berhasil, silakan login.');
				redirect('login', 'refresh');
			} else {
				$this->session->set_flashdata('pesan_error', 'Terjadi kesalahan saat menyimpan data.');
				redirect('register_customer', 'refresh');
			}
		}
	}
}
