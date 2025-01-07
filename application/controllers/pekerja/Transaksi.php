<?php
class Transaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        // Periksa apakah user sudah login
        if (!$this->session->userdata("id_user")) {
            redirect('auth', 'refresh');
        }

        // Periksa apakah Role_Id user adalah pekerja
        if ($this->session->userdata("role_id") !== 'pekerja') {
            $this->session->set_flashdata('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            redirect('no_access', 'refresh');
        }

        $this->load->model("pekerja/Mtransaksi"); // Load model
    }

    public function index()
    {
        $id_pekerja = $this->session->userdata('id_user'); // Ambil Id_Pekerja dari sesi login

        if (!$id_pekerja) {
            redirect('auth'); // Redirect jika belum login
        }

        // Ambil detail pemesanan berdasarkan Id_Pekerja
        $data['detail_pemesanan'] = $this->Mtransaksi->getDetailPemesananByPekerja($id_pekerja);

        // Load view
        $this->load->view('pekerja/header');
        $this->load->view('pekerja/transaksi', $data);
    }


    public function updateStatus()
    {
        $id_detail_pemesanan = $this->input->post('id_detail_pemesanan');

        if ($id_detail_pemesanan) {
            // Tandai pesanan sebagai selesai
            $this->db->where('Id_Detail_Pemesanan', $id_detail_pemesanan);
            $this->db->update('detail_pemesanan', ['Status_Order' => 'Selesai']);

            // Ambil semua ID pekerja yang terlibat dalam pesanan
            $this->db->select('Id_Pekerja');
            $this->db->where('Id_Detail_Pemesanan', $id_detail_pemesanan);
            $order = $this->db->get('detail_pemesanan')->row_array();

            if ($order) {
                $pekerja_ids = explode(',', $order['Id_Pekerja']); // Pisahkan ID pekerja

                // Periksa dan perbarui status untuk setiap pekerja
                foreach ($pekerja_ids as $id_pekerja) {
                    $this->db->where('Id_Pekerja', $id_pekerja);
                    $this->db->where('Status_Order', 'Pending');
                    $pending_orders = $this->db->count_all_results('detail_pemesanan');

                    // Perbarui status pekerja
                    $status_pekerja = ($pending_orders > 0) ? 'Bekerja' : 'Tidak Bekerja';
                    $this->db->where('Id_User', $id_pekerja);
                    $this->db->update('user', ['Status' => $status_pekerja]);
                }
            }

            $this->session->set_flashdata('success', 'Status berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status.');
        }

        redirect('pekerja/transaksi');
    }
}
