<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat Model yang dibutuhkan
        $this->load->model('User_model');
        // Memuat Library Form Validation (sudah di autoload, tapi ini sebagai best practice)
        $this->load->library('form_validation'); 
    }

    // --- Halaman Login ---

    public function login()
    {
        // Jika pengguna sudah login, arahkan ke dashboard yang sesuai
        if ($this->session->userdata('is_logged_in')) {
            $this->_redirect_user_based_on_role();
        }

        // Aturan validasi form
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan halaman login jika validasi gagal atau baru diakses
            $this->load->view('auth/login');
        } else {
            // Proses login
            $this->_process_login();
        }
    }

    /**
     * Logika utama proses login.
     */
    private function _process_login()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        // Panggil method login dari model
        $user = $this->User_model->login($email, $password);

        if ($user) {
            // Cek persetujuan Admin
            if ($user['is_approved'] == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Akun Anda masih menunggu persetujuan dari Admin.</div>');
                redirect('login');
            }

            // Cek status aktif
            if ($user['is_active'] == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Akun Anda telah dinonaktifkan oleh Admin.</div>');
                redirect('login');
            }

            // Data yang disimpan di session
            $data_session = array(
                'id' => $user['id'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'full_name' => $user['full_name'],
                'is_logged_in' => TRUE
            );

            $this->session->set_userdata($data_session);
            $this->_redirect_user_based_on_role();

        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Email atau Password salah.</div>');
            redirect('login');
        }
    }

    /**
     * Mengarahkan pengguna ke dashboard yang sesuai berdasarkan role.
     */
    private function _redirect_user_based_on_role()
    {
        if ($this->session->userdata('role_id') == 1) {
            // Admin
            redirect('admin'); 
        } else {
            // User
            redirect('library'); 
        }
    }

    // --- Halaman Registrasi ---

    public function register()
    {
        // Jika pengguna sudah login, arahkan ke dashboard yang sesuai
        if ($this->session->userdata('is_logged_in')) {
            $this->_redirect_user_based_on_role();
        }

        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'full_name' => htmlspecialchars($this->input->post('full_name', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'password' => $this->input->post('password'),
                'created_at' => date('Y-m-d H:i:s'),
                // role_id & is_approved di-set di User_model::register()
            ];

            if ($this->User_model->register($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Pendaftaran berhasil! Akun Anda akan aktif setelah disetujui oleh Admin.</div>');
                redirect('login');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Pendaftaran gagal, coba lagi.</div>');
                redirect('register');
            }
        }
    }

    // --- Logout ---

    public function logout()
    {
        // Hapus semua data session
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success">Anda telah berhasil logout.</div>');
        redirect('login');
    }
}