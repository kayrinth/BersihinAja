<?php 
class Customer extends CI_Controller{

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

		//panggil model Mcustomer
		$this->load->model("admin/Mcustomer");

		$data["customer"] = $this->Mcustomer->tampil();

		$this->load->view("admin/header");
		$this->load->view("admin/customer_tampil", $data);
		$this->load->view("admin/footer");
	}

	function detail($id_customer) {
		$this->load->model('admin/Mcustomer');
		$data["customer"] = $this->Mcustomer->detail($id_customer);
	
		if (empty($data["customer"])) {
			show_404(); // Tampilkan halaman 404 jika data tidak ditemukan
			return;
		}
	
		// Ambil data detail_pemesanan dengan menggunakan join
		$data['detail_pemesanan'] = $this->Mcustomer->get_detail_pemesanan_by_user($id_customer);
	
		$this->load->view('admin/header');
		$this->load->view('admin/customer_detail', $data);
		$this->load->view('admin/footer');
	}
	

}
?>
