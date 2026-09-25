<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/service/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label>Nama Layanan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="<?= old('title') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi Singkat</label>
                                <textarea class="form-control" name="short_description" rows="3" placeholder="Deskripsi pendek yang tampil di kartu layanan depan..."><?= old('short_description') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Konten Lengkap Layanan</label>
                                <textarea class="form-control tinymce-editor" name="content" rows="15"><?= old('content') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-secondary mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Ikon Layanan (Class) <i class="bi bi-info-circle text-primary" title="Gunakan class Bootstrap Icons"></i></label>
                                <input type="text" class="form-control" name="icon_class" value="<?= old('icon_class') ?>" placeholder="Misal: bi bi-laptop">
                                <small class="text-muted">Cari referensi ikon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label>Gambar Ilustrasi / Banner</label>
                                <input type="file" class="form-control mb-2" name="image" accept="image/*" onchange="previewImage(this)">
                                <img id="img_preview" src="" class="img-thumbnail mt-2" style="max-height: 150px; display: none;">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan Layanan</button>
                            <a href="<?= base_url('admin/service') ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        toolbar_mode: 'sliding',
        height: 400
    });

    function previewImage(input) {
        var preview = document.getElementById('img_preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>