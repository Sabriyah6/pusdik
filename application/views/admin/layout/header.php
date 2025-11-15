<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($title) ? $title . ' - ' : '') . 'Admin Panel PUSDIK'; ?></title>
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"> 
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>"> 
    
</head>
<body class="admin-body">

<div class="sidebar">
    <h3 class="sidebar-brand">Admin Panel</h3>
    <a href="<?php echo site_url('admin'); ?>" class="sidebar-link">Dashboard</a>
    <a href="<?php echo site_url('admin/users'); ?>" class="sidebar-link">Manajemen User</a>
    <a href="<?php echo site_url('admin/books'); ?>" class="sidebar-link">Manajemen Buku</a>
    <hr class="sidebar-divider">
    <a href="<?php echo site_url('logout'); ?>" class="sidebar-link btn-logout">Logout</a>
</div>

<div class="content">
    <h1 class="page-header"><?php echo isset($title) ? $title : 'Dashboard'; ?></h1>
    <hr>
    <?php echo $this->session->flashdata('message'); ?>