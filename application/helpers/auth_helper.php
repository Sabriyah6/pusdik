<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cek apakah pengguna saat ini adalah Admin. Jika tidak, arahkan ke halaman login
 * dan tampilkan pesan error.
 * @param object $CI Instance CodeIgniter
 */
function is_admin($CI)
{
    // Cek apakah user sudah login
    if (!$CI->session->userdata('is_logged_in')) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger">Anda harus login terlebih dahulu.</div>');
        redirect('login');
    }

    // Cek apakah role_id adalah Admin (kita asumsikan role_id = 1 adalah Admin)
    if ($CI->session->userdata('role_id') != 1) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak memiliki akses sebagai Admin.</div>');
        redirect('library'); // Arahkan ke halaman user
    }
}