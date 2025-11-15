<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body class="auth-body">

<div class="auth-box register-box">
    <h2>Daftar Akun Baru</h2>
    
    <?php echo $this->session->flashdata('message'); ?>

    <?php echo form_open('register'); ?>
        <div class="form-group">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo set_value('full_name'); ?>" class="form-control" required>
            <?php echo form_error('full_name', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" required>
            <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
            <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="passconf">Konfirmasi Password</label>
            <input type="password" id="passconf" name="passconf" class="form-control" required>
            <?php echo form_error('passconf', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <button type="submit" class="btn btn-success btn-block">Daftar Sekarang</button>
    <?php echo form_close(); ?>

    <div class="text-center auth-link">
        Sudah punya akun? <a href="<?php echo site_url('login'); ?>">Masuk di sini</a>
    </div>
</div>

<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>
</html>