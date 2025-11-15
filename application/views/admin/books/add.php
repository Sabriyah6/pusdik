<div class="card">
    <div class="card-header">
        <h4>Form Tambah Buku Baru</h4>
    </div>
    <div class="card-body">
        <?php echo form_open_multipart('admin/books/add'); ?>
            
            <div class="form-group">
                <label for="title">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title'); ?>" required>
                <?php echo form_error('title', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="author">Pengarang</label>
                <input type="text" name="author" id="author" class="form-control" value="<?php echo set_value('author'); ?>" required>
                <?php echo form_error('author', '<small class="text-danger">', '</small>'); ?>
            </div>
            
            <div class="form-group">
                <label for="category">Kategori</label>
                <input type="text" name="category" id="category" class="form-control" value="<?php echo set_value('category'); ?>" required>
                <?php echo form_error('category', '<small class="text-danger">', '</small>'); ?>
            </div>
            
            <div class="form-group">
                <label for="published_year">Tahun Terbit (4 Digit)</label>
                <input type="number" name="published_year" id="published_year" class="form-control" value="<?php echo set_value('published_year'); ?>" maxlength="4" required>
                <?php echo form_error('published_year', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Singkat</label>
                <textarea name="description" id="description" class="form-control"><?php echo set_value('description'); ?></textarea>
            </div>
            
            <hr>

            <div class="form-group">
                <label for="file_buku">Upload File Buku (PDF/EPUB, Max 50MB)</label>
                <input type="file" name="file_buku" id="file_buku" class="form-control-file" required>
                <?php echo form_error('file_buku', '<small class="text-danger">', '</small>'); ?>
            </div>
            
            <div class="form-group">
                <label for="cover_image">Upload Cover (JPG/PNG, Opsional)</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control-file">
                <?php echo $this->session->flashdata('message_cover'); // Pesan warning upload cover ?>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Buku</button>
            <a href="<?php echo site_url('admin/books'); ?>" class="btn btn-secondary mt-3">Batal</a>
        <?php echo form_close(); ?>
    </div>
</div>