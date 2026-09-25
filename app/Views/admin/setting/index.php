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
                <a href="<?= base_url('admin/setting/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Key Baru</a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Key Pengaturan</th>
                            <th>Value / Nilai</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($settings as $s): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="align-middle fw-bold font-monospace text-danger"><?= esc($s['setting_key']) ?></td>
                                <td class="align-middle text-truncate" style="max-width: 250px;">
                                    <?= esc($s['setting_value']) ?: '<span class="text-muted fst-italic">Kosong</span>' ?>
                                </td>
                                <td class="align-middle"><?= esc($s['description']) ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/setting/edit/' . $s['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="<?= base_url('admin/setting/delete/' . $s['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengaturan ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($settings)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada data pengaturan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>