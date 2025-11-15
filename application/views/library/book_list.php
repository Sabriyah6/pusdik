<div class="book-grid">
    <?php if (empty($books)): ?>
        <p class="alert alert-warning">Tidak ada buku yang ditemukan saat ini.</p>
    <?php else: ?>
        <?php foreach ($books as $book): ?>
            <div class="book-item">
                <img 
                    src="<?php echo base_url(isset($book['cover_image']) && $book['cover_image'] ? $book['cover_image'] : 'assets/img/default_cover.png'); ?>" 
                    alt="Cover <?php echo htmlspecialchars($book['title']); ?>" 
                    class="book-cover-image"
                >
                <h4 class="book-title-item"><?php echo htmlspecialchars($book['title']); ?></h4>
                <p class="book-meta">**Pengarang:** <?php echo htmlspecialchars($book['author']); ?></p>
                <p class="book-meta">**Kategori:** <?php echo htmlspecialchars($book['category']); ?></p>
                <a href="<?php echo site_url('library/read_book/' . $book['id']); ?>" class="btn btn-read">Baca Detail</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
