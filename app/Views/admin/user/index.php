<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card card-danger card-outline mb-4">
            <div class="card-header">
                <a href="<?= base_url('admin/user/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Akun</a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($users as $u): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="align-middle fw-bold"><?= esc($u['name']) ?><br><small class="text-muted fw-normal">@<?= esc($u['username']) ?></small></td>
                                <td class="align-middle"><?= esc($u['email']) ?></td>
                                <td class="align-middle"><span class="badge text-bg-<?= $u['role'] === 'superadmin' ? 'danger' : 'secondary' ?>"><?= esc(ucfirst($u['role'])) ?></span></td>
                                <td class="align-middle"><span class="badge text-bg-<?= $u['status'] == 1 ? 'success' : 'dark' ?>"><?= $u['status'] == 1 ? 'Aktif' : 'Nonaktif' ?></span></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/user/edit/' . $u['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <?php if (session()->get('user_id') != $u['id']): ?>
                                        <form action="<?= base_url('admin/user/delete/' . $u['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>