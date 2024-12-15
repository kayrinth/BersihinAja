<?php
class Mservice_detail extends CI_Model
{

    // Fungsi untuk mengambil detail layanan berdasarkan ID
    public function getServiceDetail($id_services)
    {
        $this->db->where('Id_Services', $id_services);
        $query = $this->db->get('jenis_layanan');
        return $query->row_array();
    }

    public function getAllPackages()
    {
        $query = $this->db->get('paket_layanan');
        return $query->result_array();
    }

    public function getDetailPemesananById($id_detail_pemesanan)
    {
        // Gunakan query builder bawaan CI
        $this->db->where('Id_Detail_Pemesanan', $id_detail_pemesanan);
        $query = $this->db->get('detail_pemesanan');
        return $query->row_array();
    }

    public function getPackagesByIds($ids)
    {
        $this->db->where_in('Id_Paket', $ids);
        $query = $this->db->get('paket_layanan');
        return $query->result_array();
    }
}
