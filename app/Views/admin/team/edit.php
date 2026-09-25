<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<?php
// Decode JSON menjadi array untuk dimasukkan ke form value
$socials = json_decode($team['social_links'], true) ?? [];
?>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/team/update/' . $team['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">Profil Anggota</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?= old('name', $team['name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Jabatan / Posisi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="position" value="<?= old('position', $team['position']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Biografi Singkat</label>
                                <textarea class="form-control" name="bio" rows="4"><?= old('bio', $team['bio']) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">Sosial Media</h5>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-danger"><i class="bi bi-instagram"></i></span>
                                <input type="url" class="form-control" name="social[instagram]" value="<?= $socials['instagram'] ?? '' ?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-primary"><i class="bi bi-linkedin"></i></span>
                                <input type="url" class="form-control" name="social[linkedin]" value="<?= $socials['linkedin'] ?? '' ?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-primary"><i class="bi bi-facebook"></i></span>
                                <input type="url" class="form-control" name="social[facebook]" value="<?= $socials['facebook'] ?? '' ?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-dark"><i class="bi bi-twitter-x"></i></span>
                                <input type="url" class="form-control" name="social[twitter]" value="<?= $socials['twitter'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-secondary mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Urutan Tampil (Sort Order)</label>
                                <input type="number" class="form-control" name="sort_order" value="<?= old('sort_order', $team['sort_order']) ?>" min="0">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option value="published" <?= $team['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                                    <option value="draft" <?= $team['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                                </select>
                            </div>
                            <hr>
                            <div class="mb-3 text-center">
                                <label class="d-block text-start">Foto Profil Baru <small>(Kosongkan jika tidak diubah)</small></label>
                                <?php $imgSrc = !empty($team['image']) ? base_url($team['image']) : base_url('assets/adminlte/assets/img/default-150x150.png'); ?>
                                <img id="img_preview" src="<?= $imgSrc ?>" class="rounded-circle border mb-3 mt-2" style="width: 150px; height: 150px; object-fit: cover;">
                                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(this)">
                            </div>

                            <button type="submit" class="btn btn-warning w-100 mt-2">Perbarui Anggota</button>
                            <a href="<?= base_url('admin/team') ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function previewImage(input) {
        var preview = document.getElementById('img_preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>