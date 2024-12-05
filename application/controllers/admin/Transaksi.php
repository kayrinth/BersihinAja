<?php 
class Transaksi extends CI_Controller{

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

		//panggil model Mtransaksi
		$this->load->model("admin/Mtransaksi");

		// $data["transaksi"] = $this->Mtransaksi->tampil();

		$this->load->view("admin/header");
		$this->load->view("admin/transaksi_tampil");
		// hapus, data
		$this->load->view("admin/footer");
	}

	function detail($id_transaksi){

		// //palnggil model Mtransaksi
		// $this->load->model('Mtransaksi');

		// //panggil fungsi detail()
		// $data["transaksi"] = $this->Mtransaksi->detail($id_transaksi);

		// //panggil fungsi produk_transaksi()
		// $data["transaksi_detail"] = $this->Mtransaksi->transaksi_detail($id_transaksi);



		$this->load->view("admin/header");
		$this->load->view("admin/transaksi_detail");
		// hapus, data
		$this->load->view("admin/footer");

	}
}
?>
