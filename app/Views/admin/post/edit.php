<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/post/update/' . $post['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label>Judul Artikel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="<?= old('title', $post['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Isi Artikel</label>
                                <textarea class="form-control tinymce-editor" name="content" rows="15"><?= old('content', $post['content']) ?></textarea>
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
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= $post['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option value="published" <?= $post['status'] == 'published' ? 'selected' : '' ?>>Published (Tayang)</option>
                                    <option value="draft" <?= $post['status'] == 'draft' ? 'selected' : '' ?>>Draft (Simpan Sementara)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Gambar Sampul (Thumbnail)</label>
                                <input type="file" class="form-control mb-2" name="featured_image" accept="image/*" onchange="previewImage(this)">
                                <?php
                                $imgSrc = !empty($post['featured_image']) ? base_url($post['featured_image']) : '';
                                $display = !empty($post['featured_image']) ? 'block' : 'none';
                                ?>
                                <img id="img_preview" src="<?= $imgSrc ?>" class="img-thumbnail mt-2" style="max-height: 150px; display: <?= $display ?>;">
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Perbarui Artikel</button>
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