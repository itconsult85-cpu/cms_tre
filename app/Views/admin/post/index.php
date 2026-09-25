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
                <a href="<?= base_url('admin/post/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square me-1"></i> Tulis Artikel</a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Gambar</th>
                            <th>Judul Artikel</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($posts as $p): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="align-middle">
                                    <?php if ($p['featured_image']): ?>
                                        <img src="<?= base_url($p['featured_image']) ?>" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="badge text-bg-light">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle fw-bold"><?= esc($p['title']) ?></td>
                                <td class="align-middle"><?= esc($p['category_name']) ?: '<span class="text-danger fst-italic">Tanpa Kategori</span>' ?></td>
                                <td class="align-middle text-muted"><i class="bi bi-person me-1"></i><?= esc($p['author_name']) ?: 'Unknown' ?></td>
                                <td class="align-middle">
                                    <span class="badge text-bg-<?= $p['status'] == 'published' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($p['status']) ?>
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/post/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="<?= base_url('admin/post/delete/' . $p['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus artikel ini beserta gambarnya?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($posts)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-3">Belum ada artikel.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>