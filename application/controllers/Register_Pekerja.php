<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_Pekerja extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpekerja');
	}

	public function index()
	{
		// Validasi form
		$this->form_validation->set_rules("username", "Username", "required|trim");
		$this->form_validation->set_rules("email_pekerja", "Email", "required|valid_email|trim|is_unique[pekerja.Email_Pekerja]", ['is_unique' => 'Email sudah digunakan']);
		$this->form_validation->set_rules("alamat_pekerja", "Alamat", "required|trim");
		$this->form_validation->set_rules("No_Hp", "No Telepon", "required|numeric|trim");
		$this->form_validation->set_rules("KTP", "KTP", "required|trim");
		$this->form_validation->set_rules("password", "Password", "required|min_length[3]|trim");

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register_pekerja');
		} else {
			$data = [
				'Foto_Pekerja' => $this->input->post('foto_pekerja'),
				'Username' => $this->input->post('username'),
				'Email_Pekerja' => $this->input->post('email_pekerja'),
				'KTP' => $this->input->post('KTP'),
				'Alamat_Pekerja' => $this->input->post('alamat_pekerja'),
				'No_Hp' => $this->input->post('No_Hp'),
				'Password' => sha1($this->input->post('password'))
			];


			if ($this->Mpekerja->register($data)) {
				redirect('/', 'refresh');
			} else {
				redirect('register_pekerja', 'refresh');
			}
		}
	}
}
