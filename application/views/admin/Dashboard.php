<div class="row dashboard-summary">
    
    <div class="col-4">
        <div class="card stat-card bg-primary text-white">
            <h4>Total Pengguna</h4>
            <h2><?php echo $total_users; ?></h2>
            <p>Pengguna terdaftar di sistem.</p>
        </div>
    </div>

    <div class="col-4">
        <div class="card stat-card bg-info text-white">
            <h4>Total Koleksi Buku</h4>
            <h2><?php echo $total_books; ?></h2>
            <p>Konten buku yang aktif tersedia.</p>
        </div>
    </div>

    <div class="col-4">
        <div class="card stat-card bg-warning">
            <h4>User Menunggu Persetujuan</h4>
            <h2 style="color: #856404;"><?php echo $pending_approvals; ?></h2>
            <p>Klik <a href="<?php echo site_url('admin/users'); ?>" class="link-warning">di sini</a> untuk meninjau.</p>
        </div>
    </div>
</div>

<div class="latest-activity-section" style="margin-top: 30px;">
    <h3>Aktivitas Terbaru</h3>
    <p>... Area ini bisa menampilkan 5 log aktivitas atau pendaftaran user terbaru ...</p>
</div>