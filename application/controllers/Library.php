<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model');
        
        // Memastikan User sudah login dan disetujui sebelum mengakses perpustakaan
        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role_id') != 2) {
             // Cek tambahan, meskipun sudah dilakukan di Auth.php, ini lapisan keamanan tambahan
            $user = $this->User_model->get_user_by_id($this->session->userdata('id'));
            if (!$user || $user['is_approved'] == 0) {
                 $this->session->set_flashdata('message', '<div class="alert alert-warning">Akses ditolak. Silahkan login atau tunggu persetujuan Admin.</div>');
                 redirect('login');
            }
        }
    }

    /**
     * Halaman utama perpustakaan: menampilkan daftar semua buku yang tersedia.
     */
    public function index()
    {
        $data['title'] = 'Koleksi Buku Digital';
        // Mengambil semua buku aktif
        $data['books'] = $this->Book_model->get_all_books(); 

        $this->load->view('library/layout/header', $data); // Asumsi View Layout User
        $this->load->view('library/book_list', $data);    // View daftar buku
        $this->load->view('library/layout/footer');
    }

    /**
     * Mencari daftar buku berdasarkan Judul, Kategori, atau Pengarang.
     */
    public function search()
    {
        $keyword = $this->input->get('keyword', TRUE); 
        
        $data['title'] = 'Hasil Pencarian untuk: "' . $keyword . '"';
        
        // Memanggil fungsi pencarian dari Model
        $data['books'] = $this->Book_model->search_books($keyword); 

        $this->load->view('library/layout/header', $data);
        $this->load->view('library/book_list', $data); // Tampilkan di View daftar buku
        $this->load->view('library/layout/footer');
    }

    /**
     * Menampilkan detail buku dan memberikan akses ke file untuk dibaca.
     * @param int $id ID buku
     */
    public function read_book($id)
    {
        $book = $this->Book_model->get_book_by_id($id);

        if (!$book || $book['is_active'] == 0) {
            show_404();
            return;
        }

        $data['title'] = 'Baca Buku: ' . $book['title'];
        $data['book'] = $book;
        
        // Dalam implementasi nyata, di sini Anda bisa menggunakan library viewer PDF/EPUB
        // atau mengarahkan ke halaman View khusus untuk menampilkan file.

        $this->load->view('library/layout/header', $data);
        $this->load->view('library/book_read', $data); // View untuk membaca/menampilkan file buku
        $this->load->view('library/layout/footer');
    }

    /* * CATATAN PENTING: Untuk melindungi file buku dari akses langsung (tanpa login),
     * Anda perlu membuat controller terpisah (misalnya 'File_stream') yang:
     * 1. Memeriksa status login User.
     * 2. Menggunakan fungsi PHP (seperti readfile() atau force_download di CI)
     * untuk mengirim file ke browser, bukan link langsung ke path file.
     */
}