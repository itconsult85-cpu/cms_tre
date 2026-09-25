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
                <a href="<?= base_url('admin/portfolio/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-briefcase me-1"></i> Tambah Proyek Portofolio</a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Cover</th>
                            <th>Nama Proyek</th>
                            <th>Kategori (Filter)</th>
                            <th>Klien</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($portfolios as $p): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="align-middle">
                                    <?php if ($p['cover_image']): ?>
                                        <img src="<?= base_url($p['cover_image']) ?>" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="badge text-bg-light">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle fw-bold"><?= esc($p['title']) ?></td>
                                <td class="align-middle">
                                    <?= esc($p['category_name']) ?> <br>
                                    <small class="text-muted">Slug: <code><?= esc($p['category_slug']) ?></code></small>
                                </td>
                                <td class="align-middle"><?= esc($p['client_name']) ?: '-' ?></td>
                                <td class="align-middle"><span class="badge text-bg-<?= $p['status'] == 'published' ? 'success' : 'secondary' ?>"><?= ucfirst($p['status']) ?></span></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/portfolio/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="<?= base_url('admin/portfolio/delete/' . $p['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus portofolio ini beserta SELURUH galeri gambarnya?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
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