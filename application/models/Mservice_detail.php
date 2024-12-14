<?php
class Mservice_detail extends CI_Model
{

    // Fungsi untuk mengambil detail layanan berdasarkan ID
    public function getServiceDetail($id_services)
    {
        // Query untuk memilih data dari tabel jenis_layanan berdasarkan Id_Services
        $this->db->where('Id_Services', $id_services);
        $query = $this->db->get('jenis_layanan');

        // Mengembalikan data sebagai array, jika ditemukan
        return $query->row_array();
    }

    public function getAllPackages()
    {
        $query = $this->db->get('paket_layanan'); // Mengambil semua data dari tabel paket_layanan
        return $query->result_array();
    }

    public function getPackageById($id_paket)
    {
        $this->db->where('Id_Paket', $id_paket);
        $query = $this->db->get('paket_layanan');
        return $query->row_array();
    }
    public function insertPaketPemesanan($data)
    {
        $this->db->insert('paket_pemesanan', $data);
    }
    public function saveOrder($data)
    {
        $this->db->insert('detail_pemesanan', $data);
        return $this->db->insert_id(); // Mengembalikan ID pesanan yang baru disimpan
    }
}
