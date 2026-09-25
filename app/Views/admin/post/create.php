<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/post/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label>Judul Artikel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="<?= old('title') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Isi Artikel</label>
                                <textarea class="form-control tinymce-editor" name="content" rows="15"><?= old('content') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-secondary mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" name="category_id" required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= old('category_id') == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (empty($categories)): ?>
                                    <small class="text-danger d-block mt-1">Anda belum membuat kategori untuk Post. Buat dulu di menu Kategori.</small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option value="published">Published (Tayang)</option>
                                    <option value="draft">Draft (Simpan Sementara)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Gambar Sampul (Thumbnail)</label>
                                <input type="file" class="form-control mb-2" name="featured_image" accept="image/*" onchange="previewImage(this)">
                                <img id="img_preview" src="" class="img-thumbnail mt-2" style="max-height: 150px; display: none;">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Terbitkan Artikel</button>
                            <a href="<?= base_url('admin/post') ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
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
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template help',
        toolbar_mode: 'sliding',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat help',
        height: 500
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