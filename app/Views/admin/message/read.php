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
            <div class="col-md-8 mx-auto">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-warning"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <div class="card direct-chat direct-chat-primary shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Riwayat Percakapan</h3>
                        <div class="card-tools">
                            <span title="Email Pengirim" class="badge text-bg-light"><?= esc($parentMsg['email']) ?></span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="direct-chat-messages" style="height: 400px;">

                            <?php foreach ($threads as $chat): ?>
                                <?php if ($chat['sender_type'] === 'visitor'): ?>
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-start"><?= esc($chat['name']) ?> (Pengunjung)</span>
                                            <span class="direct-chat-timestamp float-end"><?= date('d M H:i', strtotime($chat['created_at'])) ?></span>
                                        </div>
                                        <img class="direct-chat-img" src="<?= base_url('assets/adminlte/assets/img/default-150x150.png') ?>" alt="User Image">
                                        <div class="direct-chat-text bg-light text-dark border-0 shadow-sm">
                                            <?= nl2br(esc($chat['message'])) ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-end"><?= esc($chat['name']) ?> (Admin)</span>
                                            <span class="direct-chat-timestamp float-start"><?= date('d M H:i', strtotime($chat['created_at'])) ?></span>
                                        </div>
                                        <i class="direct-chat-img bi bi-person-circle display-6 text-primary float-end ms-2"></i>
                                        <div class="direct-chat-text shadow-sm">
                                            <?= nl2br(esc($chat['message'])) ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="card-footer bg-body-tertiary">
                        <form action="<?= base_url('admin/message/reply/' . $parentMsg['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="input-group">
                                <textarea name="reply_message" class="form-control" placeholder="Ketik balasan Anda di sini... Pesan ini akan dikirim otomatis ke email pengunjung." rows="2" required></textarea>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary h-100"><i class="bi bi-send-fill me-1"></i> Kirim Balasan</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <a href="<?= base_url('admin/message') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Inbox</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>