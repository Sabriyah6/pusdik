<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {

    protected $table = 'books';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Mengambil daftar semua buku tanpa filter status aktif.
     * @return array
     */
    public function get_all_books()
    {
        $this->db->order_by('published_year', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Mencari buku berdasarkan kata kunci (judul, pengarang, kategori).
     * @param string $keyword Kata kunci pencarian
     * @return array
     */
    public function search_books($keyword)
    {
        $this->db->like('title', $keyword);
        $this->db->or_like('author', $keyword);
        $this->db->or_like('category', $keyword);
        $this->db->order_by('published_year', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Mengambil data buku berdasarkan ID.
     * @param int $id ID buku
     * @return array|bool Data buku atau FALSE
     */
    public function get_book_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row_array();
    }

    // --- CRUD Admin Operations ---

    /**
     * Menambahkan data buku baru.
     * @param array $data Data buku dari form (termasuk path file dan cover)
     * @return bool Hasil operasi
     */
    public function add_book($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Memperbarui data buku yang sudah ada.
     * @param int $id ID buku yang akan diubah
     * @param array $data Data yang akan diperbarui
     * @return bool Hasil operasi
     */
    public function update_book($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Menghapus data buku secara permanen.
     * @param int $id ID buku yang akan dihapus
     * @return bool Hasil operasi
     */
    public function delete_book($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
