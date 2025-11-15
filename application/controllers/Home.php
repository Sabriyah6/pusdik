<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat Model jika diperlukan untuk menampilkan statistik publik, dll.
        $this->load->model('Book_model'); 
    }

    /**
     * Halaman utama (landing page) proyek.
     * Ini adalah $route['default_controller'].
     */
    public function index()
    {
        $data['title'] = 'Selamat Datang di Perpustakaan Digital';
        
        // Contoh: menampilkan 5 buku terbaru di halaman depan
        // Kita modifikasi Book_model.php nanti untuk membuat fungsi ini
        $this->db->limit(5);
        $this->db->order_by('created_at', 'DESC');
        $data['latest_books'] = $this->db->get('books')->result_array(); 
        
        // Memuat view layout
        $this->load->view('home/header', $data); // Asumsi: View layout untuk halaman publik
        $this->load->view('home/index', $data);  // View konten halaman utama
        $this->load->view('home/footer');
    }
}