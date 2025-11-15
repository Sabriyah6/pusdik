<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth'); 
        is_admin($this); // Proteksi Admin

        $this->load->model('Book_model');
        $this->load->model('User_model');
        $this->load->library('upload'); // Library untuk upload file
        $this->load->library('form_validation'); 
    }

    /**
     * Menampilkan daftar semua buku (Read).
     */
    public function index()
    {
        $data['title'] = 'Manajemen Konten Buku';
        $data['books'] = $this->Book_model->get_all_books(); // Mengambil semua buku aktif
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/books/list', $data); // View untuk daftar buku
        $this->load->view('admin/layout/footer', $data);
    }

    /**
     * Menampilkan form untuk menambah buku baru (Create - Form).
     */
    public function add()
    {
        $data['title'] = 'Tambah Buku Baru';

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('author', 'Pengarang', 'required|trim');
        $this->form_validation->set_rules('category', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('published_year', 'Tahun Terbit', 'required|numeric|exact_length[4]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/books/add', $data); // View form tambah
            $this->load->view('admin/layout/footer', $data);
        } else {
            $this->_do_upload_and_add();
        }
    }

    /**
     * Proses upload file dan penambahan data buku (Create - Process).
     */
    private function _do_upload_and_add()
    {
        // 1. Konfigurasi Upload File Buku (PDF/EPUB)
        $config_file['upload_path']   = './upload/files/'; // Folder di root project
        $config_file['allowed_types'] = 'pdf|epub';
        $config_file['max_size']      = 50000; // 50MB
        $config_file['encrypt_name']  = TRUE; // Ganti nama file agar unik

        $this->upload->initialize($config_file);

        if (!$this->upload->do_upload('file_buku')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal Upload File Buku: ' . $this->upload->display_errors() . '</div>');
            redirect('admin/books/add');
            return;
        }

        $file_data = $this->upload->data();
        $file_path = $config_file['upload_path'] . $file_data['file_name'];

        // 2. Konfigurasi Upload Cover (Gambar)
        $config_cover['upload_path']   = './upload/covers/';
        $config_cover['allowed_types'] = 'jpg|jpeg|png';
        $config_cover['max_size']      = 2048; // 2MB
        $config_cover['encrypt_name']  = TRUE;

        $this->upload->initialize($config_cover);
        $cover_path = '';

        if ($this->upload->do_upload('cover_image')) {
            $cover_data = $this->upload->data();
            $cover_path = $config_cover['upload_path'] . $cover_data['file_name'];
        } else {
            // Jika cover gagal diupload, berikan pesan tapi lanjutkan (cover opsional)
            $this->session->set_flashdata('message_cover', '<div class="alert alert-warning">Warning: Cover gagal diupload, tambahkan manual nanti.</div>');
        }

        // 3. Simpan Data ke Database
        $data = [
            'title'              => htmlspecialchars($this->input->post('title', TRUE)),
            'author'             => htmlspecialchars($this->input->post('author', TRUE)),
            'category'           => htmlspecialchars($this->input->post('category', TRUE)),
            'description'        => $this->input->post('description'),
            'published_year'     => $this->input->post('published_year'),
            'file_path'          => $file_path, // Path file buku yang wajib
            'cover_image'        => $cover_path, // Path cover (mungkin kosong)
            'upload_by_user_id'  => $this->session->userdata('id'),
            'created_at'         => date('Y-m-d H:i:s'),
            'is_active'          => 1 // Langsung aktif
        ];

        if ($this->Book_model->add_book($data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Buku baru berhasil ditambahkan!</div>' . $this->session->flashdata('message_cover'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menyimpan data buku ke database.</div>');
        }
        redirect('admin/books');
    }

    /**
     * Menampilkan form dan memproses edit buku (Update).
     * @param int $id ID buku
     */
    public function edit($id)
    {
        $data['book'] = $this->Book_model->get_book_by_id($id);

        if (!$data['book']) {
            show_404();
        }

        $data['title'] = 'Edit Buku: ' . $data['book']['title'];

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        // ... (aturan validasi lainnya)

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/books/edit', $data); // View form edit
            $this->load->view('admin/layout/footer', $data);
        } else {
            // Logika proses update, termasuk mengganti file buku atau cover jika di-upload
            // ... (implementasi detail update file)
            
            $update_data = [
                'title'          => htmlspecialchars($this->input->post('title', TRUE)),
                'author'         => htmlspecialchars($this->input->post('author', TRUE)),
                'description'    => $this->input->post('description'),
                // ... data lainnya
            ];

            if ($this->Book_model->update_book($id, $update_data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data buku berhasil diperbarui.</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal memperbarui data buku.</div>');
            }
            redirect('admin/books');
        }
    }

    /**
     * Menghapus buku (Soft Delete).
     * @param int $id ID buku
     */
    public function delete($id)
    {
        if ($this->Book_model->delete_book_soft($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Buku berhasil dihapus (nonaktif).</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menghapus buku.</div>');
        }
        redirect('admin/books');
    }
}