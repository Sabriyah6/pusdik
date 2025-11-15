<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan Digital</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body class="auth-body">

<div class="auth-box login-box">
    <h2>Login Perpustakaan</h2>
    
    <?php echo $this->session->flashdata('message'); ?>

    <?php echo form_open('login'); ?>
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
        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    <?php echo form_close(); ?>

    <div class="text-center auth-link">
        Belum punya akun? <a href="<?php echo site_url('register'); ?>">Daftar di sini</a>
    </div>
</div>

<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>
</html>