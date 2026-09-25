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
                <a href="<?= base_url('admin/service/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Layanan</a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th class="text-center">Ikon</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi Singkat</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($services as $s): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="text-center align-middle h4 text-danger">
                                    <i class="<?= esc($s['icon_class']) ?>"></i>
                                </td>
                                <td class="align-middle fw-bold"><?= esc($s['title']) ?></td>
                                <td class="align-middle text-truncate" style="max-width: 250px;"><?= esc($s['short_description']) ?></td>
                                <td class="align-middle"><span class="badge text-bg-<?= $s['status'] == 'published' ? 'success' : 'secondary' ?>"><?= ucfirst($s['status']) ?></span></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/service/edit/' . $s['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="<?= base_url('admin/service/delete/' . $s['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus layanan ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($services)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-3">Belum ada layanan yang ditambahkan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>