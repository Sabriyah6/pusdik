<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat helper otorisasi yang sudah dibuat
        $this->load->helper('auth'); 
        
        // Pengecekan Otorisasi: Hanya Admin (role_id = 1) yang bisa mengakses
        is_admin($this); 

        // Memuat Models yang dibutuhkan
        $this->load->model('User_model');
        $this->load->model('Book_model');
    }

    public function index()
    {
        // 1. Ambil data statistik untuk dashboard
        $data['title'] = 'Dashboard Admin';
        $data['total_users'] = $this->db->count_all('users'); // Total semua user
        $data['total_books'] = $this->db->count_all('books'); // Total semua buku
        
        // Mengambil jumlah user yang statusnya belum disetujui (is_approved = 0)
        $data['pending_approvals'] = count($this->User_model->get_unapproved_users());
        
        // 2. Muat View menggunakan layout yang telah dikoreksi
        $this->load->view('admin/layout/header', $data); // Path dikoreksi: admin/header.php
        $this->load->view('admin/dashboard', $data); 
        $this->load->view('admin/layout/footer', $data); // Path dikoreksi: admin/footer.php
    }
}