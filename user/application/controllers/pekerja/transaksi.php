<?php
class Transaksi extends CI_Controller
{

    function index()
    {

        // Load model
        //$this->load->model("Mtransaksi");

        // Ambil data transaksi
        //$data["transaksi"] = $this->Mtransaksi->tampil();

        $this->load->view('pekerja/header');
        $this->load->view('pekerja/transaksi');
        $this->load->helper('url');
    }
}
