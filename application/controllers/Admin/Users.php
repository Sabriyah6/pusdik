<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat helper otorisasi dan Model
        $this->load->helper('auth'); 
        is_admin($this); // Proteksi Admin
        
        $this->load->model('User_model');
        $this->load->model('Book_model'); // Tetap dimuat untuk konsistensi
    }

    /**
     * Menampilkan daftar semua pengguna, termasuk yang menunggu persetujuan.
     */
    public function index()
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['users'] = $this->db->get('users')->result_array(); // Ambil semua data user

        // Memuat Views dengan path yang sudah dikoreksi
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/users/list', $data); // Asumsi kita buat file admin/users/list.php
        $this->load->view('admin/layout/footer', $data);
    }

    /**
     * Fitur Pencarian Pengguna (berdasarkan ID, Username, Email).
     */
    public function search()
    {
        $keyword = $this->input->post('keyword', TRUE);
        
        $this->db->like('id', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('email', $keyword);
        
        $data['title'] = 'Hasil Pencarian Pengguna';
        $data['users'] = $this->db->get('users')->result_array();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/users/list', $data); // Asumsi kita buat file admin/users/list.php
        $this->load->view('admin/layout/footer', $data);
    }

    /**
     * Menyetujui pendaftaran pengguna baru.
     * @param int $user_id
     */
    public function approve($user_id)
    {
        if ($this->User_model->approve_user($user_id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Pengguna berhasil disetujui dan dapat login.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menyetujui pengguna.</div>');
        }
        redirect('admin/users');
    }

    /**
     * Mencabut hak akses (menonaktifkan) pengguna.
     * @param int $user_id
     */
    public function deactivate($user_id)
    {
        $this->db->where('id', $user_id);
        if ($this->db->update('users', ['is_active' => 0])) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Hak akses pengguna berhasil dicabut (dinonaktifkan).</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal mencabut hak akses pengguna.</div>');
        }
        redirect('admin/users');
    }

    /**
     * Mengaktifkan kembali hak akses pengguna.
     * @param int $user_id
     */
    public function activate($user_id)
    {
        $this->db->where('id', $user_id);
        if ($this->db->update('users', ['is_active' => 1])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Hak akses pengguna berhasil diaktifkan kembali.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal mengaktifkan hak akses pengguna.</div>');
        }
        redirect('admin/users');
    }
    
    /**
     * Menghapus pengguna secara permanen.
     * @param int $user_id
     */
    public function delete($user_id)
    {
        // PENTING: Perlu dicek apakah user tersebut Admin atau user yang sedang login!
        if ($user_id == $this->session->userdata('id')) {
             $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak bisa menghapus akun Anda sendiri!</div>');
             redirect('admin/users');
        }

        $this->db->where('id', $user_id);
        if ($this->db->delete('users')) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Pengguna berhasil dihapus permanen.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menghapus pengguna.</div>');
        }
        redirect('admin/users');
    }
}