<?php
class Mservice_detail extends CI_Model {

    // Fungsi untuk mengambil detail layanan berdasarkan ID
    public function getServiceDetail($id_services) {
        // Query untuk memilih data dari tabel jenis_layanan berdasarkan Id_Services
        $this->db->where('Id_Services', $id_services);
        $query = $this->db->get('jenis_layanan');

        // Mengembalikan data sebagai array, jika ditemukan
        return $query->row_array();
    }
}
?>
