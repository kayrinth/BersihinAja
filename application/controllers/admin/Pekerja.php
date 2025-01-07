<?php
class Pekerja extends CI_Controller
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

		//panggil model Mpekerja
		$this->load->model("admin/Mpekerja");

		$data["pekerja"] = $this->Mpekerja->tampil();

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
		foreach ($data["pekerja"] as &$cust) {
			$cust['Nama_Provinsi'] = isset($province_map[$cust['Provinsi']]) ? $province_map[$cust['Provinsi']] : 'Tidak Ditemukan';
			$cust['Nama_Kabupaten'] = isset($kabupaten_all[$cust['Kabupaten']]) ? $kabupaten_all[$cust['Kabupaten']] : 'Tidak Ditemukan';
		}

		$this->load->view("admin/header");
		$this->load->view("admin/pekerja_tampil", $data);
		$this->load->view("admin/footer");
	}

	function detail($id_pekerja)
	{
		$this->load->model('admin/Mpekerja');
		$this->load->model("pekerja/Mtransaksi");
		$data["pekerja"] = $this->Mpekerja->detail($id_pekerja);
		log_message('debug', 'Pekerja detail data: ' . print_r($data["pekerja"], true));

		if (empty($data["pekerja"])) {
			show_404(); // Tampilkan halaman 404 jika data tidak ditemukan
			return;
		}

		$data['detail_pemesanan'] = $this->Mtransaksi->getDetailPemesananByPekerja($id_pekerja);

		$this->load->view('admin/header');
		$this->load->view('admin/pekerja_detail', $data);
		$this->load->view('admin/footer');
	}
}
