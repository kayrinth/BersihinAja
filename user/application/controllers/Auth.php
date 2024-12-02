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


    public function updateUser()
    {
        $id_user = $this->session->userdata('id_user');

        $upload_path =
            $this->config->item('Foto_Customer');

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, TRUE);
        }

        // Proses upload foto
        $config['upload_path'] =
            realpath($upload_path);
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'user_' . $id_user . '_' . time();
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        // Validasi form
        $this->form_validation->set_rules('Nama_User', 'Nama User', 'trim');
        $this->form_validation->set_rules('Alamat_User', 'Alamat User', 'trim');
        $this->form_validation->set_rules('No_Hp', 'No Hp', 'numeric|trim|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->Muser->getuserById($this->session->userdata('id_user'));
            $this->load->view('auth/updateuser', $data);
        } else {
            $id_user = $this->session->userdata('id_user');
            $data = [
                'Nama_User' => $this->input->post('Nama_User'),
                'Alamat_User' => $this->input->post('Alamat_User'),
                'No_Hp' => $this->input->post('No_Hp'),
            ];

            // Cek apakah ada file foto yang diupload
            if (!empty($_FILES['foto']['name'])) {
                if ($this->upload->do_upload('foto')) {
                    $upload_data = $this->upload->data();
                    $data['Foto_User'] = $upload_data['file_name'];

                    var_dump($upload_data);
                    var_dump($_FILES['foto']);

                    // Hapus foto lama
                    $old_user = $this->Muser->getuserById($id_user);
                    if (!empty($old_user['Foto_User'])) {
                        $old_file_path = $this->config->item('Foto_Customer') . $old_user['Foto_User'];
                        if (file_exists($old_file_path)) {
                            unlink($old_file_path);
                        }
                    }
                } else {
                    $upload_error = $this->upload->display_errors();
                    $this->session->set_flashdata('pesan_error', $upload_error);
                    redirect('auth/updateUser');
                }
            }

            // Update password jika diisi
            if (!empty($this->input->post('password'))) {
                $data['Password'] = sha1($this->input->post('password'));
            }

            // Proses update user
            if ($this->Muser->updateuser($id_user, $data)) {
                $this->session->set_userdata('Nama_User', $data['Nama_User']);
                $this->session->set_flashdata('pesan_sukses', 'Profil berhasil diperbarui!');
                redirect('home');
            } else {
                $this->session->set_flashdata('pesan_error', 'Gagal memperbarui profil');
                redirect('auth/updateUser');
            }
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
