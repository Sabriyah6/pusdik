<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Load library database otomatis karena sudah di autoload.
    }

    /**
     * Memeriksa kredensial pengguna untuk login.
     * @param string $email
     * @param string $password (plain text, akan di-hash)
     * @return array|bool Data pengguna jika berhasil, atau FALSE.
     */
    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $user = $this->db->get('users')->row_array();

        // Cek apakah user ditemukan dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return FALSE;
    }

    /**
     * Mendaftarkan pengguna baru.
     * @param array $data Data pengguna (email, password, full_name)
     * @return bool Hasil operasi
     */
    public function register($data)
    {
        // Password di-hash sebelum disimpan
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['role_id'] = 2; // Default sebagai User
        $data['is_approved'] = 0; // Perlu persetujuan Admin (Pending)
        
        return $this->db->insert('users', $data);
    }

    /**
     * Mengambil daftar pengguna yang statusnya belum disetujui.
     * @return array
     */
    public function get_unapproved_users()
    {
        $this->db->where('is_approved', 0);
        $this->db->where('role_id', 2); // Hanya user biasa yang perlu disetujui
        return $this->db->get('users')->result_array();
    }

    /**
     * Mengubah status pengguna menjadi disetujui.
     * @param int $user_id ID pengguna
     * @return bool Hasil operasi
     */
    public function approve_user($user_id)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['is_approved' => 1]);
    }

    /**
     * Mengambil data pengguna berdasarkan ID.
     * @param int $id ID pengguna
     * @return array|bool Data pengguna atau FALSE
     */
    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users')->row_array();
    }
}