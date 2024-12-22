<?php
class Mtransaksi extends CI_Model
{
    public function tampil()
    {
        $this->db->select('dp.*, GROUP_CONCAT(u.Nama_User) AS nama_pekerja');
        $this->db->from('detail_pemesanan dp');
        $this->db->join('user u', 'FIND_IN_SET(u.Id_User, dp.Id_Pekerja)', 'left');
        $this->db->group_by('dp.Id_Pemesanan');
        $query = $this->db->get();

        $data = array();
        foreach ($query->result() as $row) {
            $pekerja_ids = explode(",", $row->Id_Pekerja);
            $pekerja_names = explode(",", $row->nama_pekerja);
            $pekerja_data = array();
            foreach ($pekerja_ids as $key => $id) {
                $pekerja_data[] = array(
                    'id' => $id,
                    'nama' => $pekerja_names[$key]
                );
            }
            $row->pekerja = $pekerja_data;
            $data[] = $row;
        }
        log_message('debug', 'Data yang dikembalikan: ' . print_r($data, true));

        return $data;
    }
}
