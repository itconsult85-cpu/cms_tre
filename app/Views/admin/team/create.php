<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/team/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">Profil Anggota</h5>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?= old('name') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Jabatan / Posisi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="position" value="<?= old('position') ?>" placeholder="Misal: CEO, Web Developer" required>
                            </div>
                            <div class="mb-3">
                                <label>Biografi Singkat</label>
                                <textarea class="form-control" name="bio" rows="4"><?= old('bio') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">Sosial Media <small class="text-muted fw-normal">(Opsional)</small></h5>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-danger"><i class="bi bi-instagram"></i></span>
                                <input type="url" class="form-control" name="social[instagram]" placeholder="https://instagram.com/..." value="<?= old('social.instagram') ?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-primary"><i class="bi bi-linkedin"></i></span>
                                <input type="url" class="form-control" name="social[linkedin]" placeholder="https://linkedin.com/in/..." value="<?= old('social.linkedin') ?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-primary"><i class="bi bi-facebook"></i></span>
                                <input type="url" class="form-control" name="social[facebook]" placeholder="https://facebook.com/..." value="<?= old('social.facebook') ?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white text-dark"><i class="bi bi-twitter-x"></i></span>
                                <input type="url" class="form-control" name="social[twitter]" placeholder="https://twitter.com/..." value="<?= old('social.twitter') ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-secondary mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Urutan Tampil (Sort Order) <i class="bi bi-info-circle text-primary" title="Angka 1 akan tampil paling awal"></i></label>
                                <input type="number" class="form-control" name="sort_order" value="<?= old('sort_order', 0) ?>" min="0">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                            <hr>
                            <div class="mb-3 text-center">
                                <label class="d-block text-start">Foto Profil</label>
                                <img id="img_preview" src="<?= base_url('assets/adminlte/assets/img/default-150x150.png') ?>" class="rounded-circle border mb-3 mt-2" style="width: 150px; height: 150px; object-fit: cover;">
                                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(this)">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Simpan Anggota</button>
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