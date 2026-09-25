<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/page/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label>Judul Halaman <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="<?= old('title') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Konten Halaman</label>
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
                                    <option value="published">Published (Tayang)</option>
                                    <option value="draft">Draft (Simpan Sementara)</option>
                                </select>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="show_in_menu" value="1" id="show_in_menu" checked>
                                <label class="form-check-label" for="show_in_menu">Tampilkan di menu navigasi</label>
                            </div>
                            <div class="mb-3">
                                <label>Gambar Utama (Featured Image)</label>
                                <input type="file" class="form-control mb-2" name="featured_image" accept="image/*" onchange="previewImage(this)">
                                <img id="img_preview" src="" class="img-thumbnail mt-2" style="max-height: 150px; display: none;">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label>Meta Title (SEO)</label>
                                <input type="text" class="form-control" name="meta_title" value="<?= old('meta_title') ?>">
                            </div>
                            <div class="mb-3">
                                <label>Meta Description (SEO)</label>
                                <textarea class="form-control" name="meta_description" rows="3"><?= old('meta_description') ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan Halaman</button>
                            <a href="<?= base_url('admin/page') ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
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
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
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
