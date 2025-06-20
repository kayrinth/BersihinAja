<?php
date_default_timezone_set('Asia/Jakarta');
class Service_detail extends CI_Controller
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
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('error', 'Login dulu sebelum memilih pekerja!');
            redirect('auth');
            exit;
        }

        $user_data = $this->Muser->getuserById($id_user);

        if (!$user_data) {
            $this->session->set_flashdata('error', 'Data user tidak ditemukan. Silakan login lagi.');
            redirect('auth');
            exit;
        }

        // Pastikan field kabupaten user sesuai
        $kabupaten = $user_data['Kabupaten'];

        // Ambil data pekerja berdasarkan kabupaten user
        $data['pekerja'] = $this->Muser->getPekerjaByAlamat($kabupaten);

        // var_dump($data['pekerja']);
        // exit;

        // Ambil ID layanan dari URL
        $id_services = $this->input->get('id');
        $data['detail_layanan'] = $this->Mservice_detail->getServiceDetail($id_services);

        if (empty($data['detail_layanan'])) {
            $this->session->set_flashdata('error', 'Layanan tidak ditemukan.');
            redirect('services');
            exit;
        }

        // Ambil semua data paket layanan
        $data['paket'] = $this->Mservice_detail->getAllPackages();

        // Load views
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

        $tanggal_order = date('Y-m-d H:i:s');
        $timeout_at = date('Y-m-d H:i:s', time() + (3 * 60));

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
            'Kabupaten' => $user_data['Kabupaten'],
            'Tanggal_Order' => $tanggal_order,
            'timeout_at' => $timeout_at,
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
        // Ambil data pemesanan dari session
        $data_pemesanan = $this->session->userdata('order_data');

        // Validasi data pemesanan
        if (!$data_pemesanan) {
            $this->session->set_flashdata('error', 'Data pemesanan tidak ditemukan');
            redirect('services');
            return;
        }

        try {
            // Generate unique order_id
            $order_id = uniqid() . '-' . time();
            $data_pemesanan['order_id'] = $order_id;

            // Simpan ke database
            $this->db->insert('detail_pemesanan', $data_pemesanan);
            $id_pemesanan = $this->db->insert_id();

            // Ambil detail pemesanan yang baru disimpan
            $detail_pemesanan = $this->Mservice_detail->getDetailPemesananById($id_pemesanan);

            if (!$detail_pemesanan) {
                throw new Exception('Gagal mengambil detail pemesanan');
            }

            // Siapkan data untuk nota
            $data = [
                'user_data' => $this->Muser->getUserById($data_pemesanan['Id_Customer']),
                'detail_layanan' => $this->Mservice_detail->getServiceDetail($data_pemesanan['Id_Jenis_Layanan']),
                'detail_pemesanan' => $detail_pemesanan,
            ];

            // Handle paket detail - cek jika ada paket yang dipilih
            if (!empty($data_pemesanan['Id_Paket'])) {
                $data['paket_detail'] = $this->Mservice_detail->getPackagesByIds(
                    explode(',', $data_pemesanan['Id_Paket'])
                );
            } else {
                $data['paket_detail'] = []; // Set empty array jika tidak ada paket
            }

            // Handle pekerja detail
            if (!empty($data_pemesanan['Id_Pekerja'])) {
                $data['pekerja_detail'] = $this->Muser->getUsersByIds(
                    explode(',', $data_pemesanan['Id_Pekerja'])
                );
            } else {
                throw new Exception('Data pekerja tidak ditemukan');
            }

            // Hapus data pemesanan dari session
            $this->session->unset_userdata('order_data');

            // Tampilkan nota pemesanan
            $this->load->view('header');
            $this->load->view('nota_pemesanan', $data);
            $this->load->view('footer');
        } catch (Exception $e) {
            // Log error
            log_message('error', 'Error in confirmOrder: ' . $e->getMessage());

            // Set flash message dan redirect
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memproses pesanan');
            redirect('services');
        }
    }
    public function saveOrder()
    {
        // Ambil data user dan input
        $id_customer = $this->session->userdata('id_user');
        $id_services = $this->input->post('id_services');
        $selected_paket = $this->input->post('paket');
        $selected_pekerja = $this->input->post('selected_pekerja');
        $kabupaten = $this->input->post('kabupaten');

        $selected_paket = $this->input->post('paket');
        if (empty($selected_paket)) {
            $selected_paket = []; // Set sebagai array kosong jika tidak ada paket yang dipilih
        }

        // Set waktu order dan timeout
        $tanggal_order = date('Y-m-d H:i:s');
        $timeout_at = date('Y-m-d H:i:s', time() + (3 * 60)); // 3 menit dalam detik
        $status_pembayaran = 'Belum Dibayar';

        // Generate order ID unik
        $order_id = uniqid() . '-' . time();

        // Hitung total harga layanan
        $total_harga = 0;
        $detail_layanan = $this->Mservice_detail->getServiceDetail($id_services);
        if ($detail_layanan) {
            $total_harga += $detail_layanan['Total'];
        }

        // Tambahkan harga paket jika ada
        if (!empty($selected_paket)) {
            foreach ($selected_paket as $id_paket) {
                $paket = $this->Mservice_detail->getPackageById($id_paket);
                if ($paket) {
                    $total_harga += $paket['Total'];
                }
            }
        }

        // Siapkan data untuk disimpan
        $data = [
            'Id_Jenis_Layanan' => $id_services,
            'Total' => $total_harga,
            'Status_Pembayaran' => $status_pembayaran,
            'Kabupaten' => $kabupaten,
            'Tanggal_Order' => $tanggal_order,
            'timeout_at' => $timeout_at,
            'Id_Paket' => !empty($selected_paket) ? implode(',', $selected_paket) : null,
            'Id_Pekerja' => !empty($selected_pekerja) ? implode(',', $selected_pekerja) : null,
            'Id_Customer' => $id_customer,
            'Ulasan' => null,
            'Jumlah_Rating' => null,
            'order_id' => $order_id,
            'updated_at' => $tanggal_order
        ];

        // Validasi data wajib
        if (empty($data['timeout_at'])) {
            $response = [
                'status' => 'error',
                'message' => 'Timeout tidak boleh kosong'
            ];
            echo json_encode($response);
            return;
        }

        try {
            // Simpan ke database
            $this->db->insert('detail_pemesanan', $data);
            $id_pemesanan = $this->db->insert_id();

            // Siapkan response sukses
            $response = [
                'status' => 'success',
                'message' => 'Order berhasil disimpan.',
                'id_pemesanan' => $id_pemesanan,
                'total_harga' => $total_harga,
                'timeout_at' => $timeout_at,
                'order_id' => $order_id
            ];
        } catch (Exception $e) {
            // Tangani error jika terjadi
            $response = [
                'status' => 'error',
                'message' => 'Gagal menyimpan order: ' . $e->getMessage()
            ];
        }

        // Kirim response dalam format JSON
        echo json_encode($response);
    }

    public function saveTransaction()
    {
        // Ambil data JSON dari Midtrans
        $input = json_decode(file_get_contents('php://input'), true);

        // Validasi data wajib dari Midtrans
        if (!isset($input['order_id'], $input['gross_amount'], $input['transaction_status'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid input data. Missing required fields.',
            ]);
            return;
        }

        // Ambil data dari input
        $order_id = $input['order_id'];
        $gross_amount = $input['gross_amount'];
        $transaction_status = $input['transaction_status'];

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

        $status_pembayaran = '';
        switch ($transaction_status) {
            case 'capture':
            case 'settlement':
                $status_pembayaran = 'Dibayar';
                $selected_pekerja = explode(',', $order_exists->Id_Pekerja);
                $this->load->model('Muser');
                $this->Muser->updateStatus($selected_pekerja, 'Bekerja');
                break;
            case 'pending':
                $status_pembayaran = 'Belum Dibayar';
                break;
            case 'expire':
            case 'cancel':
                $status_pembayaran = 'Dibatalkan';
                break;
            default:
                $status_pembayaran = 'Unknown';
        }

        $update_data = [
            'Total' => $gross_amount,
            'Status_Pembayaran' => $status_pembayaran,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('order_id', $order_id);
        $this->db->update('detail_pemesanan', $update_data);

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
