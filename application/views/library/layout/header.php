<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($title) ? $title . ' - ' : '') . 'Perpustakaan Digital'; ?></title>
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"> 
</head>
<body class="library-body">

<div class="lib-navbar">
    <h3>Selamat Datang, <?php echo $this->session->userdata('full_name'); ?></h3>
    <div class="nav-links">
        <a href="<?php echo site_url('library'); ?>" class="nav-link">Koleksi Buku</a>
        <a href="<?php echo site_url('logout'); ?>" class="nav-link btn-logout">Logout</a>
    </div>
</div>

<div class="container">
    <div class="search-section">
        <?php echo form_open('library/search', ['method' => 'GET', 'class' => 'search-form']); ?>
            <input type="text" name="keyword" placeholder="Cari Judul, Pengarang, Kategori..." class="form-control search-input" required value="<?php echo $this->input->get('keyword'); ?>">
            <button type="submit" class="btn btn-search">Cari</button>
        <?php echo form_close(); ?>
    </div>
    
    <h2><?php echo isset($title) ? $title : 'Koleksi Buku'; ?></h2>
    <?php echo $this->session->flashdata('message'); ?>