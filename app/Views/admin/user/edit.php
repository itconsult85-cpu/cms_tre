<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="card card-warning card-outline mb-4 w-50">
            <form action="<?= base_url('admin/user/update/' . $user['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <div class="mb-3"><label>Nama Lengkap</label><input type="text" class="form-control" name="name" value="<?= old('name', $user['name']) ?>" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" class="form-control" name="email" value="<?= old('email', $user['email']) ?>" required></div>
                    <div class="mb-3"><label>Username</label><input type="text" class="form-control" name="username" value="<?= old('username', $user['username']) ?>" required></div>
                    <div class="mb-3"><label>Password Baru <small>(Kosongkan jika tidak diubah)</small></label><input type="password" class="form-control" name="password" minlength="6"></div>
                    <div class="mb-3"><label>Role</label>
                        <select class="form-select" name="role" required>
                            <option value="author" <?= $user['role'] == 'author' ? 'selected' : '' ?>>Author</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="superadmin" <?= $user['role'] == 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                        </select>
                    </div>
                    <div class="mb-3"><label>Status</label>
                        <select class="form-select" name="status" required>
                            <option value="1" <?= $user['status'] == 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= $user['status'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                    <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>