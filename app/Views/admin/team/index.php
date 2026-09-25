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
                <a href="<?= base_url('admin/team/create') ?>" class="btn btn-primary btn-sm"><i class="bi bi-person-plus-fill me-1"></i> Tambah Anggota</a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">Urutan</th>
                            <th class="text-center">Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Sosial Media</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teams as $t): ?>
                            <tr>
                                <td class="text-center align-middle fw-bold"><?= $t['sort_order'] ?></td>
                                <td class="text-center align-middle">
                                    <?php if ($t['image']): ?>
                                        <img src="<?= base_url($t['image']) ?>" class="rounded-circle border" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <i class="bi bi-person-circle text-muted" style="font-size: 2.5rem;"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle fw-bold"><?= esc($t['name']) ?></td>
                                <td class="align-middle text-muted"><?= esc($t['position']) ?></td>
                                <td class="align-middle h5">
                                    <?php
                                    $socials = json_decode($t['social_links'], true);
                                    if (!empty($socials['instagram'])) echo '<a href="' . esc($socials['instagram']) . '" target="_blank" class="text-danger me-2"><i class="bi bi-instagram"></i></a>';
                                    if (!empty($socials['linkedin']))  echo '<a href="' . esc($socials['linkedin']) . '" target="_blank" class="text-primary me-2"><i class="bi bi-linkedin"></i></a>';
                                    if (!empty($socials['facebook']))  echo '<a href="' . esc($socials['facebook']) . '" target="_blank" class="text-primary me-2"><i class="bi bi-facebook"></i></a>';
                                    if (!empty($socials['twitter']))   echo '<a href="' . esc($socials['twitter']) . '" target="_blank" class="text-dark"><i class="bi bi-twitter-x"></i></a>';
                                    ?>
                                </td>
                                <td class="align-middle"><span class="badge text-bg-<?= $t['status'] == 'published' ? 'success' : 'secondary' ?>"><?= ucfirst($t['status']) ?></span></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/team/edit/' . $t['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="<?= base_url('admin/team/delete/' . $t['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus anggota tim ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($teams)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-3">Belum ada anggota tim yang ditambahkan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>