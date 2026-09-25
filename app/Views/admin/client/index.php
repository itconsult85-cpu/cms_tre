<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="card card-danger card-outline mb-4">
            <div class="card-header"><a href="<?= base_url('admin/client/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Klien</a></div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center">Urutan</th>
                            <th>Logo</th>
                            <th>Nama Klien</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $c): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $c['sort_order'] ?></td>
                                <td class="align-middle"><img src="<?= base_url($c['logo']) ?>" style="height: 40px; object-fit: contain;"></td>
                                <td class="align-middle fw-bold"><?= esc($c['name']) ?></td>
                                <td class="align-middle"><span class="badge text-bg-<?= $c['status'] == 'published' ? 'success' : 'secondary' ?>"><?= ucfirst($c['status']) ?></span></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/client/edit/' . $c['id']) ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="<?= base_url('admin/client/delete/' . $c['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus klien ini?');">
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