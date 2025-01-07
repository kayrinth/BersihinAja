<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mhistory extends CI_Model
{

    public function get_user_transactions($user_id)
    {
        $this->db->select('
        d.*, 
        s.Nama_Layanan, 
        GROUP_CONCAT(DISTINCT p.Nama_Paket SEPARATOR ", ") as nama_paket, 
        u.Nama_User as Nama_Customer, 
        GROUP_CONCAT(DISTINCT pekerja.Nama_User SEPARATOR ", ") as nama_pekerja
    ');
        $this->db->from('detail_pemesanan d');
        $this->db->join('user u', 'd.Id_Customer = u.Id_User', 'left');
        $this->db->join('jenis_layanan s', 'd.Id_Jenis_Layanan = s.Id_Services');
        $this->db->join('paket_layanan p', 'FIND_IN_SET(p.Id_Paket, d.Id_Paket) > 0', 'left');
        $this->db->join('user pekerja', 'FIND_IN_SET(pekerja.Id_User, d.Id_Pekerja) > 0', 'left');
        $this->db->where('d.Id_Customer', $user_id);
        $this->db->group_by('d.Id_Detail_Pemesanan');
        $this->db->order_by('d.Tanggal_Order', 'DESC');
        return $this->db->get()->result();
    }



    public function get_transaction_by_order_id($order_id)
    {
        return $this->db->where('order_id', $order_id)
            ->get('detail_pemesanan')
            ->row();
    }

    public function update_transaction_status($order_id, $status)
    {
        return $this->db->where('order_id', $order_id)
            ->update('detail_pemesanan', ['Status_Pembayaran' => $status]);
    }

    public function update_order_id($old_order_id, $new_order_id)
    {
        return $this->db->where('order_id', $old_order_id)
            ->update('detail_pemesanan', ['order_id' => $new_order_id]);
    }

    public function get_transaction_details($user_id)
    {
        return $this->db->select('*')
            ->from('detail_pemesanan')
            ->where('Id_Customer', $user_id)
            ->order_by('Tanggal_Order', 'DESC')
            ->get()
            ->result_array();
    }
    public function update_rating($order_id, $data)
    {
        return $this->db->where('order_id', $order_id)
            ->update('detail_pemesanan', $data);
    }
}
