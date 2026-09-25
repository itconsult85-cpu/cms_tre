<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/service/update/' . $service['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label>Nama Layanan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="<?= old('title', $service['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi Singkat</label>
                                <textarea class="form-control" name="short_description" rows="3"><?= old('short_description', $service['short_description']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Konten Lengkap Layanan</label>
                                <textarea class="form-control tinymce-editor" name="content" rows="15"><?= old('content', $service['content']) ?></textarea>
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
                                    <option value="published" <?= $service['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                                    <option value="draft" <?= $service['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Ikon Layanan (Class)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="<?= esc($service['icon_class']) ?>" id="icon_preview"></i></span>
                                    <input type="text" class="form-control" name="icon_class" id="icon_input" value="<?= old('icon_class', $service['icon_class']) ?>" onkeyup="updateIcon()">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label>Gambar Ilustrasi / Banner</label>
                                <input type="file" class="form-control mb-2" name="image" accept="image/*" onchange="previewImage(this)">
                                <?php $display = !empty((string)$service['image']) ? 'block' : 'none'; ?>
                                <img id="img_preview" src="<?= base_url((string)$service['image']) ?>" class="img-thumbnail mt-2" style="max-height: 150px; display: <?= $display ?>;">
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Perbarui Layanan</button>
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
    // Update live preview ikon di form
    function updateIcon() {
        var iconInput = document.getElementById('icon_input').value;
        document.getElementById('icon_preview').className = iconInput;
    }
</script>
<?= $this->endSection() ?>