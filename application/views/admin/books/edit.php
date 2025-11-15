<div class="card">
    <div class="card-header">
        <h4>Edit Buku: <?php echo htmlspecialchars($book['title']); ?></h4>
    </div>
    <div class="card-body">
        <?php echo form_open_multipart('admin/books/edit/' . $book['id']); ?>
            
            <div class="form-group">
                <label for="title">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control" 
                       value="<?php echo set_value('title', $book['title']); ?>" required>
                <?php echo form_error('title', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="author">Pengarang</label>
                <input type="text" name="author" id="author" class="form-control" 
                       value="<?php echo set_value('author', $book['author']); ?>" required>
                <?php echo form_error('author', '<small class="text-danger">', '</small>'); ?>
            </div>
            
            <div class="form-group">
                <label for="category">Kategori</label>
                <input type="text" name="category" id="category" class="form-control" 
                       value="<?php echo set_value('category', $book['category']); ?>" required>
                <?php echo form_error('category', '<small class="text-danger">', '</small>'); ?>
            </div>
            
            <div class="form-group">
                <label for="published_year">Tahun Terbit (4 Digit)</label>
                <input type="number" name="published_year" id="published_year" class="form-control" 
                       value="<?php echo set_value('published_year', $book['published_year']); ?>" maxlength="4" required>
                <?php echo form_error('published_year', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Singkat</label>
                <textarea name="description" id="description" class="form-control"><?php echo set_value('description', $book['description']); ?></textarea>
            </div>
            
            <hr>
            
            <p><strong>File Buku Saat Ini:</strong> <?php echo $book['file_path'] ? '<a href="' . base_url($book['file_path']) . '" target="_blank">Lihat File</a>' : 'Tidak ada file.'; ?></p>
            <div class="form-group">
                <label for="file_buku">Ganti File Buku (PDF/EPUB, Max 50MB) *Kosongkan jika tidak diganti*</label>
                <input type="file" name="file_buku" id="file_buku" class="form-control-file">
                <?php echo form_error('file_buku', '<small class="text-danger">', '</small>'); ?>
            </div>
            
            <p><strong>Cover Saat Ini:</strong> 
                <?php if ($book['cover_image']): ?>
                    <img src="<?php echo base_url($book['cover_image']); ?>" alt="Cover" style="max-height: 80px; vertical-align: middle;">
                <?php else: ?>
                    Tidak ada Cover.
                <?php endif; ?>
            </p>
            <div class="form-group">
                <label for="cover_image">Ganti Cover (JPG/PNG) *Kosongkan jika tidak diganti*</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control-file">
                <?php echo $this->session->flashdata('message_cover'); ?>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
            <a href="<?php echo site_url('admin/books'); ?>" class="btn btn-secondary mt-3">Batal</a>
        <?php echo form_close(); ?>
    </div>
</div>