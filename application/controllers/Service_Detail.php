<?php
class Service_Detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Mservice_detail');
        $this->load->model('Muser');
    }

    public function index()
    {

        $id_services = $this->input->get('id');

        $id_user = $this->session->userdata('id_user');

        $user_data = $this->Muser->getuserById($id_user);
        $this->session->set_userdata('id_user', $user_data['Id_User']);


        if ($user_data) {
            $data['pekerja'] = $this->Muser->getPekerjaByAlamat($user_data['Alamat_User']);
        } else {
            $data['pekerja'] = [];
        }
        $data['detail_layanan'] = $this->Mservice_detail->getServiceDetail($id_services);

        if (empty($data['detail_layanan'])) {
            $this->session->set_flashdata('error', 'Layanan tidak ditemukan.');
            redirect('services');
        }

        // Ambil semua data paket
        $data['paket'] = $this->Mservice_detail->getAllPackages();

        $this->load->view('header');
        $this->load->view('service_detail', $data);
        $this->load->view('footer');
    }

    public function showDetail($id_detail_pemesanan)
    {
        // Memanggil model untuk mendapatkan detail pemesanan
        $detail_pemesanan = $this->model->getDetailPemesananById($id_detail_pemesanan);

        if ($detail_pemesanan) {
            // Jika data ditemukan, tampilkan detail pemesanan
            return $detail_pemesanan;
        } else {
            // Jika data tidak ditemukan, beri pesan
            echo "Pemesanan tidak ditemukan.";
        }
    }
    public function order()
    {
        $id_user = $this->session->userdata('id_user');
        $user_data = $this->Muser->getUserById($id_user);

        $selected_paket = $this->input->post('paket');
        $selected_pekerja = $this->input->post('selected_pekerja');
        $id_services = $this->input->get('id') ?? $this->input->post('id_services');

        $detail_layanan = $this->Mservice_detail->getServiceDetail($id_services);

        // Validasi minimal satu pekerja dipilih
        if (empty($selected_pekerja)) {
            $this->session->set_flashdata('error', 'Anda wajib memilih minimal satu pekerja!');
            redirect('service_detail/order?id=' . $id_services);
            return;
        }

        // Lanjutkan proses validasi pekerja...
        $maxSelection = 0;
        switch ($id_services) {
            case 1:
                $maxSelection = 1;
                break;
            case 2:
                $maxSelection = 3;
                break;
            default:
                $maxSelection = PHP_INT_MAX;
        }

        if (count($selected_pekerja) > $maxSelection) {
            $this->session->set_flashdata(
                'error',
                "Maksimal hanya $maxSelection pekerja yang dapat dipilih untuk layanan ini."
            );
            redirect('service_detail?id=' . $id_services);
            return;
        }

        $paket_detail = [];
        if (!empty($selected_paket)) {
            foreach ($selected_paket as $id_paket) {
                $paket_detail[] = $this->Mservice_detail->getPackagesByIds($id_paket);
            }
        }

        // Fetch user details for each pekerja (worker) based on their ID
        $pekerja_detail = [];
        if (!empty($selected_pekerja)) {
            foreach ($selected_pekerja as $id_pekerja) {
                $pekerja_detail[] = $this->Muser->getUserById($id_pekerja);
            }
        }


        // Hitung total harga
        $total_harga = $detail_layanan['Harga']; // Mulai dengan harga layanan

        // Tambahkan harga paket
        if (!empty($selected_paket)) {
            foreach ($selected_paket as $id_paket) {
                $paket = $this->Mservice_detail->getPackagesByIds([$id_paket]); // Harus mengirim array
                if (!empty($paket)) {
                    $total_harga += $paket[0]['Harga']; // Ambil elemen pertama dari hasil query
                }
            }
        }
        // Generate order_id
        $order_id = uniqid() . '-' . time();

        // Simpan data pemesanan ke session (sementara)
        $data_pemesanan = [
            'Id_Jenis_Layanan' => $id_services,
            'Total' => $total_harga,
            'Status_Pembayaran' => 'Belum Dibayar',
            'Alamat' => $user_data['Alamat_User'],
            'Tanggal_Order' => date('Y-m-d H:i:s'),
            'Id_Paket' => !empty($selected_paket) ? implode(',', $selected_paket) : null,
            'Id_Pekerja' => !empty($selected_pekerja) ? implode(',', $selected_pekerja) : null,
            'Id_Customer' => $id_user,
            'order_id' => $order_id, // Tambahkan order_id
        ];

        $this->session->set_userdata('order_data', $data_pemesanan);


        // Redirect ke halaman konfirmasi atau nota pemesanan
        redirect('service_detail/confirmOrder');
    }

    public function confirmOrder()
    {
        $data_pemesanan = $this->session->userdata('order_data');

        if (!$data_pemesanan) {
            redirect('services');
        }

        // Generate unique order_id for Midtrans
        $order_id = uniqid() . '-' . time();  // Format order_id untuk Midtrans

        // Tambahkan order_id ke dalam data pemesanan
        $data_pemesanan['order_id'] = $order_id; // Menyimpan order_id untuk Midtrans

        // Simpan data pemesanan ke database
        $this->db->insert('detail_pemesanan', $data_pemesanan);
        $id_pemesanan = $this->db->insert_id(); // Id_Detail_Pemesanan adalah auto-generated ID

        // Mengambil detail pemesanan yang baru disimpan
        $detail_pemesanan = $this->Mservice_detail->getDetailPemesananById($id_pemesanan);

        // Siapkan data untuk ditampilkan di nota
        $data['user_data'] = $this->Muser->getUserById($data_pemesanan['Id_Customer']);
        $data['detail_layanan'] = $this->Mservice_detail->getServiceDetail($data_pemesanan['Id_Jenis_Layanan']);
        $data['paket_detail'] = $this->Mservice_detail->getPackagesByIds(explode(',', $data_pemesanan['Id_Paket']));
        $data['pekerja_detail'] = $this->Muser->getUsersByIds(explode(',', $data_pemesanan['Id_Pekerja']));
        $data['detail_pemesanan'] = $detail_pemesanan;

        // Hapus data pemesanan dari session
        $this->session->unset_userdata('order_data');

        // Tampilkan nota pemesanan
        $this->load->view('header');
        $this->load->view('nota_pemesanan', $data);
        $this->load->view('footer');
    }

    public function saveOrder()
    {
        $id_customer = $this->session->userdata('id_user');
        $id_services = $this->input->post('id_services');
        $selected_paket = $this->input->post('paket');
        $selected_pekerja = $this->input->post('selected_pekerja');

        $alamat = $this->input->post('alamat');
        $tanggal_order = date('Y-m-d H:i:s');
        $status_pembayaran = 'Pending'; // Ubah menjadi Pending untuk Midtrans

        // Hitung total harga
        $total_harga = 0;
        $detail_layanan = $this->Mservice_detail->getServiceDetail($id_services);
        if ($detail_layanan) {
            $total_harga += $detail_layanan['Total'];
        }

        // Tambahkan harga paket
        if (!empty($selected_paket)) {
            foreach ($selected_paket as $id_paket) {
                $paket = $this->Mservice_detail->getPackageById($id_paket);
                if ($paket) {
                    $total_harga += $paket['Total'];
                }
            }
        }
        $order_id = uniqid() . '-' . time();
        // Siapkan data untuk disimpan
        $data = [
            'Id_Jenis_Layanan' => $id_services,
            'Total' => $total_harga,
            'Status_Pembayaran' => $status_pembayaran,
            'Alamat' => $alamat,
            'Tanggal_Order' => $tanggal_order,
            'Id_Paket' => !empty($selected_paket) ? implode(',', $selected_paket) : null,
            'Id_Pekerja' => !empty($selected_pekerja) ? implode(',', $selected_pekerja) : null,
            'Id_Customer' => $id_customer,
            'Ulasan' => null,
            'Jumlah_Rating' => null,
            'order_id' => $order_id,
        ];

        // Simpan data dan dapatkan ID pemesanan
        $this->db->insert('detail_pemesanan', $data);
        $id_pemesanan = $this->db->insert_id();

        // Mengembalikan respons dalam bentuk JSON
        $response = [
            'status' => 'success',
            'message' => 'Order berhasil disimpan.',
            'id_pemesanan' => $id_pemesanan,
            'total_harga' => $total_harga,
        ];

        echo json_encode($response);
    }

    public function saveTransaction()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        // Validasi data dari Midtrans
        if (!isset($input['order_id']) || !isset($input['gross_amount'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid input data. Missing order_id or gross_amount.',
            ]);
            return;
        }

        // Ambil data dari Midtrans
        $order_id = $input['order_id'];
        $gross_amount = $input['gross_amount'];

        // Periksa apakah order_id ada di database
        $this->db->where('order_id', $order_id);
        $order_exists = $this->db->get('detail_pemesanan')->row();

        if (!$order_exists) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Order ID not found in database.',
            ]);
            return;
        }

        // Update data transaksi di tabel detail_pemesanan
        $this->db->where('order_id', $order_id);
        $this->db->update('detail_pemesanan', [
            'Total' => $gross_amount,
            'Status_Pembayaran' => 'Dibayar',
        ]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Transaction updated successfully.',
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update transaction. Possibly no changes were made.',
            ]);
        }
    }
}
