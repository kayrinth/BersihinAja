<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mservices extends CI_Model
{
    public function getServiceById($id_services)
    {
        return $this->db->get_where('Jenis_Layanan', ['Id_Services' => $id_services])->row_array();
    }

    // public function updateuser($id_user, $data)
    // {
    //     // Filter data kosong
    //     $data = array_filter($data, function ($value) {
    //         return $value !== null && $value !== '';
    //     });

    //     // Cek apakah ada data untuk diupdate
    //     if (empty($data)) {
    //         return false;
    //     }

    //     // Update database
    //     $this->db->where('Id_User', $id_user);
    //     $update = $this->db->update('user', $data);

    //     // Log error jika gagal
    //     if (!$update) {
    //         log_message('error', 'Gagal update user: ' . $this->db->error()['message']);
    //         return false;
    //     }

    //     return true;
    // }


    function tampilServices()
    {
        $this->db->select('Id_Services, Nama_Layanan, Harga, Foto_Layanan, Jumlah_Cleaner, Ukuran_Ruangan, Maksimal_Jam, Estimasi');
        $this->db->from('jenis_layanan');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            log_message('error', 'Tidak ada layanan: ' . $this->db->last_query());
            return [];
        }
    }
}
