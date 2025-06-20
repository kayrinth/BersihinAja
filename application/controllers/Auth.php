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
                redirect('pekerja/beranda');
            } else {
                redirect('/');
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
            // Cocokkan password menggunakan password_verify
            if (password_verify($password, $user['Password'])) {
                // Set session untuk user yang berhasil login
                $data = [
                    'id_user'    => $user['Id_User'],
                    'Email_User' => $user['Email_User'],
                    'Nama_User'  => $user['Nama_User'],
                    'role_id'    => $user['Role_Id'],
                ];
                $this->session->set_userdata($data);

                // Periksa Role_Id untuk menentukan redirect
                if ($user['Role_Id'] == 'customer') {
                    redirect('/');
                } elseif ($user['Role_Id'] == 'pekerja') {
                    redirect('pekerja/beranda');
                } elseif ($user['Role_Id'] == 'admin') {
                    redirect('admin/home');
                } else {
                    $this->session->set_flashdata('error', 'Role tidak dikenali.');
                    redirect('auth');
                }
            } else {
                // Password salah
                $this->session->set_flashdata('error', 'Email dan Password salah');
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
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            log_message('error', 'CURL Error (Provinsi): ' . curl_error($ch));
            show_error('Gagal mengambil data provinsi. Silakan coba beberapa saat lagi.');
        }
        curl_close($ch);

        $provinces = json_decode($response, true);
        if (!$provinces) {
            log_message('error', 'JSON Decode Error (Provinsi)');
            show_error('Data provinsi tidak valid. Silakan coba beberapa saat lagi.');
        }

        $data['provinces'] = $provinces;

        // Validasi form
        $this->form_validation->set_rules('Nama_User', 'Nama User', 'required|trim');
        $this->form_validation->set_rules('Email_User', 'Email User', 'required|trim|valid_email|is_unique[user.Email_User]', ['is_unique' => 'Email sudah digunakan']);
        $this->form_validation->set_rules('Provinsi', 'provinsi', 'required');
        $this->form_validation->set_rules('Kabupaten', 'kabupaten', 'required');
        $this->form_validation->set_rules('No_Hp', 'No Hp', 'required|numeric|trim|max_length[15]');
        $this->form_validation->set_rules('KTP', 'KTP', 'required|numeric|trim|max_length[16]');
        $this->form_validation->set_rules('role_id', 'Role Id', 'required|in_list[pekerja,customer]', ['required' => 'Role wajib dipilih', 'in_list' => 'Role tidak valid']);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');

        if ($this->form_validation->run() == false) {
            log_message('debug', 'Form validation failed: ' . json_encode($this->form_validation->error_array()));
            $this->load->view('auth/registUser', $data);
        } else {
            $role = $this->input->post('role_id');
            $status = ($role == 'pekerja') ? 'tidak bekerja' : '';

            $data = [
                'Nama_User' => $this->input->post('Nama_User'),
                'Email_User' => $this->input->post('Email_User'),
                'Provinsi' => $this->input->post('Provinsi'),
                'Kabupaten' => $this->input->post('Kabupaten'),
                'No_Hp' => $this->input->post('No_Hp'),
                'KTP' => $this->input->post('KTP'),
                'Role_Id' => $role,
                'Password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'Status' => $status
            ];

            if ($this->Muser->registerUser($data)) {
                $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert"> Akun Berhasil Dibuat, Silahkan Login </div>');
                redirect('auth');
            } else {
                log_message('error', 'Gagal register user di database: ' . json_encode($data));
                $this->session->set_flashdata('pesan_gagal', '<div class="alert alert-danger" role="alert"> Gagal Membuat Akun, Silahkan Coba Lagi </div>');
                redirect('auth/registUser');
            }
        }
    }


    public function registPekerja()
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $data['provinces'] = json_decode($response, true);


        $this->form_validation->set_rules('Nama_User', 'Nama User', 'required|trim');
        $this->form_validation->set_rules('Email_User', 'Email User', 'required|trim|valid_email|is_unique[user.Email_User]', ['is_unique' => 'Email sudah digunakan']);
        $this->form_validation->set_rules('Provinsi', 'provinsi', 'required');
        $this->form_validation->set_rules('Kabupaten', 'kabupaten', 'required');
        $this->form_validation->set_rules('No_Hp', 'No Hp', 'required|numeric|trim|max_length[15]');
        $this->form_validation->set_rules('KTP', 'KTP', 'required|numeric|trim|max_length[16]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('pekerja/registPekerja', $data);
        } else {

            $data = [
                'Nama_User' => $this->input->post('Nama_User'),
                'Email_User' => $this->input->post('Email_User'),
                'Provinsi' => $this->input->post('Provinsi'),
                'Kabupaten' => $this->input->post('Kabupaten'),
                'No_Hp' => $this->input->post('No_Hp'),
                'KTP' => $this->input->post('KTP'),
                'Role_Id' => "pekerja",
                'Password' => sha1($this->input->post('password')),
                'Status' => "Tidak Bekerja"
            ];

            if ($this->Muser->registerUser($data)) {
                $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert"> Akun Berhasil Dibuat, Silahkan Login </div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('pesan_gagal', '<div class="alert alert-danger" role="alert"> Gagal Membuat Akun, Silahkan Coba Lagi </div>');
                redirect('pekerja/registPekerja');
            }
        }
    }

    public function getKabupaten()
    {
        $provinsi_id = $this->input->post('provinsi_id');
        if (empty($provinsi_id)) {
            echo json_encode(['error' => 'No provinsi ID provided']);
            return;
        }

        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" . $provinsi_id . ".json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
            curl_close($ch);
            return;
        }

        curl_close($ch);

        if ($response) {
            echo $response;
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }

    public function updateUser()
    {
        $id_user = $this->session->userdata('id_user');

        // Get provinces data for the dropdown
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $data['provinces'] = json_decode($response, true);

        $upload_path = $this->config->item('Foto_Customer');

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, TRUE);
        }

        // Upload configuration
        $config['upload_path'] = realpath($upload_path);
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $config['file_name'] = 'user_' . $id_user . '_' . time();
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        // Form validation
        $this->form_validation->set_rules('Nama_User', 'Nama User', 'trim');
        $this->form_validation->set_rules('No_Hp', 'No Hp', 'numeric|trim|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]');
        $this->form_validation->set_rules('Provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('Kabupaten', 'Kabupaten', 'required');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->Muser->getuserById($this->session->userdata('id_user'));

            // If user has province, get kabupaten data
            if (!empty($data['user']['Provinsi'])) {
                $kab_url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" . $data['user']['Provinsi'] . ".json";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $kab_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $kab_response = curl_exec($ch);
                curl_close($ch);

                $data['kabupatens'] = json_decode($kab_response, true);
            }

            $this->load->view('auth/updateuser', $data);
        } else {
            $data = [
                'Nama_User' => $this->input->post('Nama_User'),
                'No_Hp' => $this->input->post('No_Hp'),
                'Provinsi' => $this->input->post('Provinsi'),
                'Kabupaten' => $this->input->post('Kabupaten')
            ];

            // Handle photo upload
            if (!empty($_FILES['foto']['name'])) {
                if ($this->upload->do_upload('foto')) {
                    $upload_data = $this->upload->data();
                    $data['Foto_User'] = $upload_data['file_name'];

                    // Delete old photo
                    $old_user = $this->Muser->getuserById($id_user);
                    if (!empty($old_user['Foto_User'])) {
                        $old_file_path = $this->config->item('Foto_Customer') . $old_user['Foto_User'];
                        if (file_exists($old_file_path)) {
                            unlink($old_file_path);
                        }
                    }
                } else {
                    $this->session->set_flashdata('pesan_error', $this->upload->display_errors());
                    redirect('auth/updateUser');
                }
            }

            // Update password if provided
            if (!empty($this->input->post('password'))) {
                $data['Password'] = sha1($this->input->post('password'));
            }

            // Update user
            if ($this->Muser->updateuser($id_user, $data)) {
                $this->session->set_userdata('Nama_User', $data['Nama_User']);
                $this->session->set_flashdata('pesan_sukses', 'Profil berhasil diperbarui!');

                $user = $this->Muser->getuserById($id_user);

                if ($user['Role_Id'] == 'customer') {
                    redirect('/');
                } elseif ($user['Role_Id'] == 'pekerja') {
                    redirect('pekerja/beranda');
                } else {
                    $this->session->set_flashdata('pesan_error', 'Role tidak dikenali');
                    redirect('auth');
                }
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