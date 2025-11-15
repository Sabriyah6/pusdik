<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/*
| -------------------------------------------------------------------
|  Default Controller
| -------------------------------------------------------------------
| Halaman yang dimuat saat mengakses root URL (e.g., http://localhost/perpus/)
*/
$route['default_controller'] = 'Home'; 

/*
| -------------------------------------------------------------------
|  Authentication (Login & Register)
| -------------------------------------------------------------------
| Menggunakan Controller Auth.php
*/
$route['login']    = 'Auth/login';
$route['register'] = 'Auth/register';
$route['logout']   = 'Auth/logout';

/*
| -------------------------------------------------------------------
|  User Routes (Library Access)
| -------------------------------------------------------------------
| Fungsionalitas inti untuk User (Melihat dan Membaca Buku)
| Menggunakan Controller Library.php
*/
$route['library']     = 'Library/index';              // Menampilkan daftar semua buku
$route['books/(:num)'] = 'Library/read_book/$1';      // Untuk membaca detail/file buku (e.g., /books/123)
$route['search']      = 'Library/search';             // Untuk fitur pencarian buku (Judul/Kategori/Pengarang)

/*
| -------------------------------------------------------------------
|  Admin Routes
| -------------------------------------------------------------------
| Semua permintaan ke 'admin/*' diarahkan ke Controller di subfolder 'Admin'
*/
// Dashboard Admin
$route['admin'] = 'Admin/Dashboard';

// Manajemen Pengguna oleh Admin
$route['admin/users']           = 'Admin/Users/index';
$route['admin/users/(:any)']    = 'Admin/Users/$1'; 
// E.g., /admin/users/approve/5

// Manajemen Konten Buku (CRUD) oleh Admin
$route['admin/books']           = 'Admin/Books/index';
$route['admin/books/(:any)']    = 'Admin/Books/$1';
// E.g., /admin/books/add, /admin/books/edit/10

/*
| -------------------------------------------------------------------
|  404 Override
| -------------------------------------------------------------------
| Pastikan ini tetap ada untuk menangani URL yang tidak ditemukan
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;