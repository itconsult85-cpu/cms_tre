<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <a href="<?= base_url('admin/slider/create') ?>" class="btn btn-primary btn-sm">Tambah Slide</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped m-0">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sliders as $s): ?>
                            <tr>
                                <td><img src="<?= base_url($s['image']) ?>" style="height: 50px; border-radius: 5px;"></td>
                                <td class="align-middle"><strong><?= esc($s['title']) ?></strong></td>
                                <td class="align-middle"><?= ucfirst($s['status']) ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/slider/edit/' . $s['id']) ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="<?= base_url('admin/slider/delete/' . $s['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus slide?')">
                                        <?= csrf_field() ?><button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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