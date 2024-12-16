<?php
class Mtransaksi extends CI_Model
{
    function tampil()
    {
        // Melakukan query untuk mengambil semua data transaksi
        $q = $this->db->get("transaksi");
        return $q->result_array(); // Mengembalikan hasil sebagai array
    }
}
