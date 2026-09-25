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

        <div class="card card-primary card-outline">
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped m-0">
                    <tbody>
                        <?php foreach ($messages as $m): ?>
                            <tr class="<?= $m['is_read'] == 0 ? 'fw-bold bg-light' : '' ?>">
                                <td style="width: 50px;" class="text-center">
                                    <?= $m['is_read'] == 0 ? '<i class="bi bi-envelope-fill text-primary"></i>' : '<i class="bi bi-envelope-open text-muted"></i>' ?>
                                </td>
                                <td><?= esc($m['name']) ?></td>
                                <td><a href="<?= base_url('admin/message/read/' . $m['id']) ?>" class="text-dark text-decoration-none"><?= esc($m['subject']) ?></a></td>
                                <td class="text-muted text-truncate" style="max-width: 200px;"><?= esc($m['message']) ?></td>
                                <td class="text-muted small text-end"><?= date('d M Y, H:i', strtotime($m['created_at'])) ?></td>
                                <td class="text-end">
                                    <form action="<?= base_url('admin/message/delete/' . $m['id']) ?>" method="post" onsubmit="return confirm('Hapus percakapan ini?');">
                                        <?= csrf_field() ?>
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($messages)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Hore! Kotak masuk Anda bersih.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>