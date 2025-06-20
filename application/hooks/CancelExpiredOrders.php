<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CancelExpiredOrders
{
    public function cancel()
    {
        $CI = &get_instance();
        $CI->load->database();

        $current_time = date('Y-m-d H:i:s');

        // Cari pesanan yang sudah melewati batas waktu
        $CI->db->where("(Status_Pembayaran = 'Belum Dibayar' OR Status_Pembayaran = 'Pending')");
        $CI->db->where('timeout_at IS NOT NULL');
        $CI->db->where('timeout_at <=', $current_time);
        $expired_orders = $CI->db->get('detail_pemesanan')->result();

        foreach ($expired_orders as $order) {
            // Update menggunakan Id_Detail_Pemesanan
            $CI->db->where('Id_Detail_Pemesanan', $order->Id_Detail_Pemesanan);
            $CI->db->update('detail_pemesanan', [
                'Status_Pembayaran' => 'Dibatalkan',
                'updated_at' => $current_time
            ]);

            // Log untuk monitoring
            log_message('info', 'Pesanan dengan ID: ' . $order->Id_Detail_Pemesanan . ' dibatalkan karena melewati batas waktu');
        }

        if (count($expired_orders) > 0) {
            log_message('info', 'Total pesanan yang dibatalkan: ' . count($expired_orders));
        }
    }
}
