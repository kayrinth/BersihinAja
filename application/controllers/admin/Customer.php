<?php
class Customer extends CI_Controller
{

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


	function index()
	{

		$this->load->model("admin/Mcustomer");

		$data["customer"] = $this->Mcustomer->tampil();

		// Ambil data provinsi dari API
		$url_provinsi = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";
		$provinsi_json = file_get_contents($url_provinsi);
		$provinsi = json_decode($provinsi_json, true);

		// Peta provinsi dengan ID
		$province_map = [];
		foreach ($provinsi as $prov) {
			$province_map[$prov['id']] = $prov['name'];
		}

		$kabupaten_all = [];
		foreach ($provinsi as $prov) {
			$url_kabupaten = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" . $prov['id'] . ".json";
			$kabupaten_json = file_get_contents($url_kabupaten);
			$kabupaten = json_decode($kabupaten_json, true);

			foreach ($kabupaten as $kab) {
				$kabupaten_all[$kab['id']] = $kab['name'];
			}
		}

		// Gabungkan data customer dengan nama provinsi dan kabupaten
		foreach ($data["customer"] as &$cust) {
			$cust['Nama_Provinsi'] = isset($province_map[$cust['Provinsi']]) ? $province_map[$cust['Provinsi']] : 'Tidak Ditemukan';
			$cust['Nama_Kabupaten'] = isset($kabupaten_all[$cust['Kabupaten']]) ? $kabupaten_all[$cust['Kabupaten']] : 'Tidak Ditemukan';
		}

		// Load view
		$this->load->view("admin/header");
		$this->load->view("admin/customer_tampil", $data);
		$this->load->view("admin/footer");
	}


	function detail($id_customer)
	{
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
