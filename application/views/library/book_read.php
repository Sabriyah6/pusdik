<div class="book-detail-page">
    <a href="<?php echo site_url('library'); ?>" class="btn-back">&larr; Kembali ke Koleksi</a>
    
    <h2 class="detail-title"><?php echo htmlspecialchars($book['title']); ?></h2>
    
    <div class="detail-content">
        <div class="cover-section">
            <img 
                src="<?php echo base_url(isset($book['cover_image']) && $book['cover_image'] ? $book['cover_image'] : 'assets/img/default_cover.png'); ?>" 
                alt="Cover <?php echo htmlspecialchars($book['title']); ?>" 
                class="book-cover-large"
            >
        </div>
        <div class="metadata-section">
            <p><strong>Pengarang:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Kategori:</strong> <?php echo htmlspecialchars($book['category']); ?></p>
            <p><strong>Tahun Terbit:</strong> <?php echo htmlspecialchars($book['published_year']); ?></p>
            
            <h3 class="desc-heading">Deskripsi</h3>
            <p class="book-description"><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
            
            <hr>
            
            <a href="<?php echo base_url($book['file_path']); ?>" target="_blank" class="btn btn-primary btn-read-file">
                <i class="icon-read"></i> Buka File Buku (<?php echo strtoupper(pathinfo($book['file_path'], PATHINFO_EXTENSION)); ?>)
            </a>
            
        </div>
    </div>
</div>