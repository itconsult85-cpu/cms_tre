<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="card card-primary card-outline mb-4 w-50">
            <form action="<?= base_url('admin/user/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <div class="mb-3"><label>Nama Lengkap</label><input type="text" class="form-control" name="name" value="<?= old('name') ?>" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" class="form-control" name="email" value="<?= old('email') ?>" required></div>
                    <div class="mb-3"><label>Username</label><input type="text" class="form-control" name="username" value="<?= old('username') ?>" required></div>
                    <div class="mb-3"><label>Password</label><input type="password" class="form-control" name="password" required minlength="6"></div>
                    <div class="mb-3"><label>Role</label>
                        <select class="form-select" name="role" required>
                            <option value="author">Author</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>