<?php
defined('BASEPATH') or exit('No direct script access allowed');
include 'midtrans-php/Midtrans.php';
class History extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Pastikan user sudah login
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }

        // Load model dan library yang dibutuhkan
        $this->load->model('Mhistory');
        // $this->load->library('midtrans');
    }

    public function index()
    {
        // Ambil ID user dari session
        $user_id = $this->session->userdata('id_user');

        // Ambil history transaksi
        $data['transactions'] = $this->Mhistory->get_user_transactions($user_id);

        // Load view
        $this->load->view('header');
        $this->load->view('history/index', $data);
        $this->load->view('footer');
    }

    public function repay($order_id)
    {
        try {
            // Ambil detail transaksi
            $detail_pemesenan = $this->Mhistory->get_transaction_by_order_id($order_id);

            // Validasi transaksi
            if (!$detail_pemesenan) {
                show_404();
            }

            // Cek status pembayaran
            if ($detail_pemesenan->Status_Pembayaran != 'Belum Dibayar') {
                $this->session->set_flashdata('error', 'Transaksi tidak dapat dibayar ulang.');
                redirect('history');
            }

            // Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = 'SB-Mid-server-sDOZNKYY7IIJOfOJg5nlBWr3';
            \Midtrans\Config::$clientKey = 'SB-Mid-client-D-4z0cOLlQa1lamX';
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            // Persiapan parameter transaksi
            $new_order_id = $detail_pemesenan->order_id . '-' . time();

            // Persiapan parameter transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => $new_order_id,
                    'gross_amount' => (int)$detail_pemesenan->Total
                ],
                'customer_details' => [
                    'first_name' => $this->session->userdata('Nama_User'),
                    'email' => $this->session->userdata('email'),
                ]
            ];
            $this->Mhistory->update_order_id($detail_pemesenan->order_id, $new_order_id);
            // Generate Snap Token
            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);

                // Log token untuk debugging
                log_message('debug', 'Midtrans Snap Token: ' . $snapToken);
            } catch (Exception $e) {
                // Log error token generation
                log_message('error', 'Midtrans Token Error: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Gagal membuat token pembayaran: ' . $e->getMessage());
                redirect('history');
            }

            // Siapkan data untuk view
            $data = [
                'detail_pemesanan' => $detail_pemesenan,
                'snapToken' => $snapToken
            ];

            // Load view
            $this->load->view('header');
            $this->load->view('history/repay', $data);
            $this->load->view('footer');
        } catch (Exception $e) {
            // Tangani error umum
            log_message('error', 'Repay Error: ' . $e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('history');
        }
    }
    public function payment_callback()
    {
        // Midtrans membutuhkan konfigurasi server key
        \Midtrans\Config::$serverKey = 'your_server_key';
        \Midtrans\Config::$isProduction = false;

        try {
            // Terima notifikasi dari Midtrans
            $notif = \Midtrans\Transaction::notification();

            $order_id = $notif->order_id;
            $transaction_status = $notif->transaction_status;
            $fraud_status = $notif->fraud_status;

            // Cari transaksi di database
            $transaction = $this->Mhistory->get_transaction_by_order_id($order_id);

            if (!$transaction) {
                // Log transaksi tidak ditemukan
                log_message('error', 'Transaksi tidak ditemukan: ' . $order_id);
                http_response_code(404);
                exit;
            }

            // Update status berdasarkan berbagai kondisi
            if ($transaction_status == 'capture') {
                if ($fraud_status == 'challenge') {
                    // Transaksi mungkin palsu
                    $status = 'challenge';
                } else {
                    // Transaksi berhasil
                    $status = 'success';
                }
            } elseif ($transaction_status == 'settlement') {
                // Transaksi berhasil
                $status = 'success';
            } elseif ($transaction_status == 'pending') {
                // Transaksi masih pending
                $status = 'pending';
            } elseif ($transaction_status == 'deny') {
                // Transaksi ditolak
                $status = 'failed';
            } elseif ($transaction_status == 'expire') {
                // Transaksi kadaluarsa
                $status = 'expired';
            } elseif ($transaction_status == 'cancel') {
                // Transaksi dibatalkan
                $status = 'cancelled';
            }

            // Update status transaksi di database
            $this->Mhistory->update_transaction_status($order_id, $status);

            // Log status
            log_message('info', "Midtrans Callback - Order ID: $order_id, Status: $status");

            // Kirim respons ke Midtrans
            http_response_code(200);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            // Tangani error
            log_message('error', 'Midtrans Callback Error: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
