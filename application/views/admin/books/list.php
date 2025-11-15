<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Daftar Konten Buku</h4>
        <a href="<?php echo site_url('admin/books/add'); ?>" class="btn btn-success">Tambah Buku Baru</a>
    </div>
    
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Tahun Terbit</th>
                    <th>File Path</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($books)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada buku yang diunggah.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo $book['id']; ?></td>
                            <td><?php echo htmlspecialchars($book['title']); ?></td>
                            <td><?php echo htmlspecialchars($book['author']); ?></td>
                            <td><?php echo htmlspecialchars($book['category']); ?></td>
                            <td><?php echo $book['published_year']; ?></td>
                            <td><small><?php echo htmlspecialchars($book['file_path']); ?></small></td>
                            <td>
                                <a href="<?php echo site_url('admin/books/edit/' . $book['id']); ?>" class="btn btn-sm btn-info">Edit</a>
                                <a href="<?php echo site_url('admin/books/delete/' . $book['id']); ?>" class="btn btn-sm btn-danger confirm-action" data-text="hapus (nonaktifkan) buku ini?">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>