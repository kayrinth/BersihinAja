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
        $this->db->where('Id_User', $id_user);
        $this->db->update('user', $data);
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
