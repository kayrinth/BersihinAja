<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Muser extends CI_Model
{
    public function getuserById($id_user)
    {
        return $this->db->get_where('user', ['Id_User' => $id_user])->row_array();
    }

    public function updateuser($id_user, $data)
    {
        // Filter data kosong
        $data = array_filter($data, function ($value) {
            return $value !== null && $value !== '';
        });

        // Cek apakah ada data untuk diupdate
        if (empty($data)) {
            return false;
        }

        // Update database
        $this->db->where('Id_User', $id_user);
        $update = $this->db->update('user', $data);

        // Log error jika gagal
        if (!$update) {
            log_message('error', 'Gagal update user: ' . $this->db->error()['message']);
            return false;
        }

        return true;
    }

    public function tampil()
    {
        return $this->db->get("user")->result_array();
    }

    public function registerUser($data)
    {
        if ($this->db->insert('user', $data)) {
            log_message('info', 'Data user berhasil disimpan: ' . json_encode($data));
            return true;
        } else {
            log_message('error', 'Query gagal dijalankan: ' . $this->db->last_query());
            return false;
        }
    }
}
