<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Mcustomer');
    }
    public function index()
    {
        // Cek apakah user sudah login, jika sudah redirect ke halaman home
        if ($this->session->userdata('email_customer')) {
            redirect('home');
        }

        $this->form_validation->set_rules('email_customer', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email_customer');
        $password = $this->input->post('password');

        $user = $this->db->get_where('customer', ['Email_Customer' => $email])->row_array();

        if ($user) {

            $db_password = isset($user['Password']) ? $user['Password'] : null;

            if ($db_password && $db_password === sha1($password)) {

                $data = [
                    'id_customer' => $user['Id_Customer'],
                    'email_customer' => $user['Email_Customer'],
                    'username' => $user['Username'],
                ];
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-danger" role="alert">Email & Password salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan_gagal', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
            redirect('auth');
        }
    }



    public function registCustomer()
    {
        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("email_customer", "Email", "required|trim|valid_email|is_unique[customer.Email_Customer]", ['is_unique' => 'Email sudah digunakan']);
        $this->form_validation->set_rules("alamat_customer", "Alamat", "required|trim");
        $this->form_validation->set_rules("No_Hp", "No Telepon", "required|numeric|trim");
        $this->form_validation->set_rules("password", "Password", "required|min_length[3]|trim");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/registCustomer');
        } else {
            $data = [
                'Username' => $this->input->post('username'),
                'Email_Customer' => $this->input->post('email_customer'),
                'Alamat_Customer' => $this->input->post('alamat_customer'),
                'No_Hp' => $this->input->post('No_Hp'),
                'Password' => sha1(trim($this->input->post('password')))
            ];

            $this->db->insert('customer', $data);
            $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert"> Selamat Akun Anda Berhasil Dibuat!, Silakan Login </div>');
            redirect('auth', 'refresh');
        }
    }


    public function registPekerja()
    {
        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("email_pekerja", "Email", "required|trim|valid_email|is_unique[pekerja.Email_Pekerja]", ['is_unique' => 'Email sudah digunakan']);
        $this->form_validation->set_rules("alamat_pekerja", "Alamat", "required|trim");
        $this->form_validation->set_rules("No_Hp", "No Telepon", "required|numeric|trim");
        $this->form_validation->set_rules("KTP", "KTP", "required|numeric|trim|min_length[16]|max_length[16]");
        $this->form_validation->set_rules("password", "Password", "required|min_length[3]|trim");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/registPekerja');
        } else {
            $data = [
                'Username' => $this->input->post('username'),
                'Email_Pekerja' => $this->input->post('email_pekerja'),
                'Alamat_Pekerja' => $this->input->post('alamat_pekerja'),
                'No_Hp' => $this->input->post('No_Hp'),
                'KTP' => $this->input->post('KTP'),
                'Password' => sha1(trim($this->input->post('password')))
            ];

            $this->db->insert('pekerja', $data);
            $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert"> Selamat Akun Anda Berhasil Dibuat!, Silakan Login </div>');
            redirect('auth', 'refresh');
        }
    }

    public function updateCustomer()
    {
        // Validasi form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat', 'required');
        $this->form_validation->set_rules('No_Hp', 'No Telepon', 'required|numeric');

        if ($this->form_validation->run() == false) {
            // Jika validasi gagal, kembalikan ke halaman update
            $data['customer'] = $this->Mcustomer->getCustomerById($this->session->userdata('id_customer'));
            $this->load->view('auth/updateCustomer', $data);
        } else {
            // Ambil data dari form
            $id_customer = $this->session->userdata('id_customer');
            $data = [
                'Username' => $this->input->post('username'),
                'Alamat_Customer' => $this->input->post('alamat_customer'),
                'No_Hp' => $this->input->post('No_Hp'),
                'Foto_Customer' => $this->input->post('foto')
            ];

            // Perbarui database
            $this->Mcustomer->updateCustomer($id_customer, $data);

            $this->session->set_userdata('username', $data['Username']);
            $this->session->set_flashdata('pesan_sukses', 'Profil berhasil diperbarui!');

            redirect('/');
        }
    }

    public function logout()
    {
        //menghnacurkan tiker yang dibuat saat login tadi
        $this->session->unset_userdata("id_customer");
        $this->session->unset_userdata("email_customer");
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("alamat_customer");
        $this->session->unset_userdata("no_hp");


        $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert"> Anda Telah Berhasil Logout </div>');

        redirect('auth', 'refresh');
    }
}
