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

        <div class="card card-danger card-outline mb-4">
            <div class="card-header">
                <a href="<?= base_url('admin/page/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Buat Halaman</a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Judul Halaman</th>
                            <th>URL (Slug)</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pages as $p): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="align-middle fw-bold"><?= esc($p['title']) ?></td>
                                <td class="align-middle text-muted">/<?= esc($p['slug']) ?></td>
                                <td class="align-middle">
                                    <span class="badge text-bg-<?= $p['status'] == 'published' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($p['status']) ?>
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/page/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="<?= base_url('admin/page/delete/' . $p['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus halaman ini beserta gambarnya?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($pages)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-3">Belum ada halaman dibuat.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>