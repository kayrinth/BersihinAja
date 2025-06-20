<?php
class Mtransaksi extends CI_Model
{
    public function getDetailPemesananByPekerja($id_pekerja)
    {
        $this->db->select('
        dp.*, 
        u.Nama_User as Nama_Customer, 
        jl.Nama_Layanan, 
        pl.Nama_Paket, 
        u.Status
    ');
        $this->db->from('detail_pemesanan dp');
        $this->db->join('user u', 'dp.Id_Customer = u.Id_User', 'left');
        $this->db->join('jenis_layanan jl', 'dp.Id_Jenis_Layanan = jl.Id_Services', 'left');
        $this->db->join('paket_layanan pl', 'dp.Id_Paket = pl.Id_Paket', 'left');
        $this->db->where("FIND_IN_SET('$id_pekerja', dp.Id_Pekerja) >", 0);

        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function getPemesananStatus($id_detail_pemesanan)
    {
        $this->db->select('Status_Order');
        $this->db->where('Id_Detail_Pemesanan', $id_detail_pemesanan);
        return $this->db->get('detail_pemesanan')->row_array();
    }
}
