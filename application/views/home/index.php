<h2>Selamat Datang di Perpustakaan Digital PUSDIK</h2>
    <p>Akses koleksi buku digital kami secara penuh setelah Anda mendaftar dan akun Anda disetujui oleh Admin.</p>
    
    <hr>
    
    <h3>Buku Terbaru Kami</h3>
    <?php if (empty($latest_books)): ?>
        <p>Saat ini belum ada buku yang diunggah oleh Admin.</p>
    <?php else: ?>
        <div class="book-grid"> 
        <?php foreach ($latest_books as $book): ?>
            <div class="book-card">
                <img src="<?php echo base_url(isset($book['cover_image']) && $book['cover_image'] ? $book['cover_image'] : 'assets/img/default_cover.png'); ?>" alt="Cover" class="book-cover">
                <h4 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h4>
                <p class="book-author">Oleh: **<?php echo htmlspecialchars($book['author']); ?>**</p>
                <p class="book-year">Tahun: <?php echo htmlspecialchars($book['published_year']); ?></p>
                <a href="<?php echo site_url('login'); ?>" class="btn-read-public">Login untuk Baca</a>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>