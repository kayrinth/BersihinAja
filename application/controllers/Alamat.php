<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat extends CI_Controller
{
    public function index()
    {
        // URL API untuk Provinsi
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/";

        // Mengambil data menggunakan cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode JSON
        $data['provinces'] = json_decode($response, true);

        // Load View
        $this->load->view('alamat', $data);
    }
}
