<?php 
class Home extends CI_Controller{


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

	public function index(){

		// $this->load->model('Mmember');
		// $data["jumlah_member_distrik"] = $this->Mmember->jumlah_member_distrik();


		$this->load->view("admin/header");
		$this->load->view("admin/home"); 
		// hapus ,data
		$this->load->view("admin/footer");
	}
}
?>
