<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($title) ? $title . ' - ' : '') . 'Perpustakaan Digital PUSDIK'; ?></title>
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"> 
</head>
<body>

<div class="navbar">
    <h3>Perpustakaan Digital PUSDIK</h3>
    <div>
        <a href="<?php echo site_url('/'); ?>">Home</a>
        <a href="<?php echo site_url('login'); ?>">Login</a>
        <a href="<?php echo site_url('register'); ?>">Daftar</a>
    </div>
</div>

<div class="container">
    <?php echo $this->session->flashdata('message'); ?>