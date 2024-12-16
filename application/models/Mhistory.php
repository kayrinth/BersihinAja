<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mhistory extends CI_Model
{

    public function get_user_transactions($user_id)
    {

        return $this->db->where('id_customer', $user_id)
            ->order_by('tanggal_order', 'DESC')
            ->get('detail_pemesanan')
            ->result();
    }

    public function get_transaction_by_order_id($order_id)
    {
        // Ambil detail transaksi berdasarkan order_id
        return $this->db->where('order_id', $order_id)
            ->get('detail_pemesanan')
            ->row();
    }

    public function update_transaction_status($order_id, $status)
    {
        // Update status transaksi
        $this->db->where('order_id', $order_id)
            ->update('transactions', ['status' => $status]);
    }

    public function update_order_id($old_order_id, $new_order_id)
    {
        // Update order_id lama ke order_id baru
        return $this->db->where('order_id', $old_order_id)
            ->update('detail_pemesanan', ['order_id' => $new_order_id]);
    }
}
