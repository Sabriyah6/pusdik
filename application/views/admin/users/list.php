<div class="card">
    <div class="card-header">
        <h4>Daftar Semua Pengguna</h4>
        <?php echo form_open('admin/users/search', ['class' => 'search-form', 'method' => 'POST']); ?>
            <input type="text" name="keyword" placeholder="Cari Email atau ID..." class="form-control-sm">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        <?php echo form_close(); ?>
    </div>
    
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status Disetujui</th>
                    <th>Status Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pengguna.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <span class="badge badge-<?php echo ($user['role_id'] == 1) ? 'danger' : 'success'; ?>">
                                    <?php echo ($user['role_id'] == 1) ? 'ADMIN' : 'USER'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($user['is_approved'] == 1): ?>
                                    <span class="badge badge-success">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Menunggu</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($user['is_active'] == 1): ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($user['role_id'] != 1): // Admin tidak bisa mengubah status Admin lain ?>
                                    <?php if ($user['is_approved'] == 0): ?>
                                        <a href="<?php echo site_url('admin/users/approve/' . $user['id']); ?>" class="btn btn-sm btn-success confirm-action" data-text="setujui pengguna ini?">Setujui</a>
                                    <?php endif; ?>

                                    <?php if ($user['is_active'] == 1): ?>
                                        <a href="<?php echo site_url('admin/users/deactivate/' . $user['id']); ?>" class="btn btn-sm btn-warning confirm-action" data-text="nonaktifkan pengguna ini?">Nonaktifkan</a>
                                    <?php else: ?>
                                        <a href="<?php echo site_url('admin/users/activate/' . $user['id']); ?>" class="btn btn-sm btn-info confirm-action" data-text="aktifkan pengguna ini?">Aktifkan</a>
                                    <?php endif; ?>

                                    <a href="<?php echo site_url('admin/users/delete/' . $user['id']); ?>" class="btn btn-sm btn-danger confirm-action" data-text="hapus permanen pengguna ini?" onclick="return confirm('Yakin menghapus pengguna ini? Tindakan tidak dapat dibatalkan.')">Hapus</a>
                                <?php else: ?>
                                    <small>(Admin)</small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>