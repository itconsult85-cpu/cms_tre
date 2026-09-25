<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <div class="card card-danger card-outline mb-4">
                    <div class="card-header">
                        <a href="<?= base_url('admin/category/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Kategori</a>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped table-hover m-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Slug (URL)</th>
                                    <th>Peruntukan (Tipe)</th>
                                    <th class="text-center" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($categories as $c): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $no++ ?></td>
                                        <td class="align-middle fw-bold"><?= esc($c['name']) ?></td>
                                        <td class="align-middle text-muted">/<?= esc($c['slug']) ?></td>
                                        <td class="align-middle">
                                            <?php
                                            $badgeColor = 'primary';
                                            if ($c['type'] == 'portfolio') $badgeColor = 'success';
                                            if ($c['type'] == 'service') $badgeColor = 'warning text-dark';
                                            ?>
                                            <span class="badge text-bg-<?= $badgeColor ?>"><?= strtoupper($c['type']) ?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('admin/category/edit/' . $c['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                            <form action="<?= base_url('admin/category/delete/' . $c['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($categories)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-3">Belum ada kategori yang ditambahkan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="alert alert-info">
                    <h5><i class="bi bi-info-circle-fill me-2"></i> Info Kategori</h5>
                    <p class="mb-0 small">Kategori digunakan untuk mengelompokkan konten agar lebih rapi. Anda wajib menentukan apakah kategori ini digunakan untuk <strong>Artikel (Post)</strong>, <strong>Portofolio (Project)</strong>, atau <strong>Layanan (Service)</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>