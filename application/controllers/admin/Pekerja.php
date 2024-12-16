<?php 
class Pekerja extends CI_Controller{

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


	function index(){

		//panggil model Mpekerja
		$this->load->model("admin/Mpekerja");

		$data["pekerja"] = $this->Mpekerja->tampil();

		$this->load->view("admin/header");
		$this->load->view("admin/pekerja_tampil", $data);
		$this->load->view("admin/footer");
	}

	function detail($id_pekerja) {
		$this->load->model('admin/Mpekerja');
		$data["pekerja"] = $this->Mpekerja->detail($id_pekerja);
		log_message('debug', 'Pekerja detail data: ' . print_r($data["pekerja"], true));
	
		if (empty($data["pekerja"])) {
			show_404(); // Tampilkan halaman 404 jika data tidak ditemukan
			return;
		}
	
		$this->load->view('admin/header');
		$this->load->view('admin/pekerja_detail', $data);
		$this->load->view('admin/footer');
	}

}
?>
