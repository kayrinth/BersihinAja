<?php
class Mpemesanan extends CI_Model
{
    // Simpan data detail_pemesanan
    public function saveDetailPemesanan($data)
    {
        $this->db->insert('detail_pemesanan', $data);
        return $this->db->insert_id(); // Mengembalikan ID detail_pemesanan yang baru dibuat
    }

    // Simpan relasi pekerja dengan detail_pemesanan
    // public function savePemesananPekerja($data)
    // {
    //     $this->db->insert('pemesanan', $data); // Tabel relasi pekerja (jika ada)
    // }
}

