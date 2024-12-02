<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'session']);
        $this->load->helper('url');
        $this->load->model('Muser');
    }

    public function index()
    {
        if ($this->session->userdata('email_user')) {
            if ($this->session->userdata('role_id') == 'pekerja') {
                redirect('beranda');
            } else {
                redirect('home');
            }
        }

        $this->form_validation->set_rules('email_user', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email_user');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['Email_User' => $email])->row_array();

        if ($user) {
            // Cocokkan password menggunakan hashing
            if ($user['Password'] === sha1($password)) {
                // Set session untuk user yang berhasil login
                $data = [
                    'id_user' => $user['Id_User'],
                    'Email_User' => $user['Email_User'],
                    'Nama_User' => $user['Nama_User'],
                    'role_id' => $user['Role_Id'],
                ];
                $this->session->set_userdata($data);

                // Periksa Role_Id untuk menentukan redirect
                if ($user['Role_Id'] == 'customer') {
                    redirect('home');
                } elseif ($user['Role_Id'] == 'pekerja') {
                    redirect('beranda');
                } else {
                    $this->session->set_flashdata('error', 'Role tidak dikenali.');
                    redirect('auth');
                }
            } else {
                // Password salah
                $this->session->set_flashdata('error', 'Password salah.');
                redirect('auth');
            }
        } else {
            // Email tidak ditemukan
            $this->session->set_flashdata('error', 'Email tidak terdaftar.');
            redirect('auth');
        }
    }


    public function registUser()
    {
        $this->form_validation->set_rules('Nama_User', 'Nama User', 'required|trim');
        $this->form_validation->set_rules('Email_User', 'Email User', 'required|trim|valid_email|is_unique[user.Email_User]', ['is_unique' => 'Email sudah digunakan']);
        $this->form_validation->set_rules('Alamat_User', 'Alamat User', 'required|trim');
        $this->form_validation->set_rules('No_Hp', 'No Hp', 'required|numeric|trim|max_length[15]');
        $this->form_validation->set_rules('KTP', 'KTP', 'required|numeric|trim|max_length[16]');
        $this->form_validation->set_rules('role_id', 'Role Id', 'required|in_list[pekerja,customer]', ['required' => 'Role wajib dipilih', 'in_list' => 'Role tidak valid']);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('auth/registUser');
        } else {
            $data = [
                'Nama_User' => $this->input->post('Nama_User'),
                'Email_User' => $this->input->post('Email_User'),
                'Alamat_User' => $this->input->post('Alamat_User'),
                'No_Hp' => $this->input->post('No_Hp'),
                'KTP' => $this->input->post('KTP'),
                'Role_Id' => $this->input->post('role_id'),
                'Password' => sha1($this->input->post('password')),
            ];

            if ($this->Muser->registerUser($data)) {
                $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert"> Akun Berhasil Dibuat, Silahkan Login </div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('pesan_gagal', '<div class="alert alert-danger" role="alert"> Gagal Membuat Akun, Silahkan Coba Lagi </div>');
                redirect('auth/registUser');
            }
        }
    }


    public function updateuser()
    {
        // Validasi form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('alamat_user', 'Alamat', 'required');
        $this->form_validation->set_rules('No_Hp', 'No Telepon', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->Muser->getuserById($this->session->userdata('id_user'));
            $this->load->view('auth/updateuser', $data);
        } else {
            // Ambil data dari form
            $id_user = $this->session->userdata('id_user');
            $data = [
                'Username' => $this->input->post('username'),
                'Alamat_user' => $this->input->post('alamat_user'),
                'No_Hp' => $this->input->post('No_Hp'),
                'Foto_user' => $this->input->post('foto')
            ];

            // Perbarui database
            $this->Muser->updateuser($id_user, $data);

            $this->session->set_userdata('username', $data['Username']);
            $this->session->set_flashdata('pesan_sukses', 'Profil berhasil diperbarui!');

            redirect('/');
        }
    }

    public function logout()
    {
        //menghnacurkan tiker yang dibuat saat login tadi
        $this->session->unset_userdata("id_user");
        $this->session->unset_userdata("email_user");
        $this->session->unset_userdata("nama_user");
        $this->session->unset_userdata("alamat_user");
        $this->session->unset_userdata("no_hp");

        $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert"> Anda Telah Berhasil Logout </div>');

        redirect('auth', 'refresh');
    }
}
