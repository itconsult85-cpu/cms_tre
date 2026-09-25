<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>

<div class="app-content-header">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card card-warning card-outline w-75">
            <form action="<?= base_url('admin/slider/update/' . $slider['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="fw-bold">Judul Slide</label>
                        <input type="text" name="title" class="form-control" value="<?= old('title', $slider['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Deskripsi Singkat</label>
                        <textarea name="description" class="form-control" rows="3"><?= old('description', $slider['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Link URL (Tombol)</label>
                        <input type="text" name="link_url" class="form-control" placeholder="https://..." value="<?= old('link_url', $slider['link_url']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Gambar Slide</label>
                        <input type="file" name="image" class="form-control mb-2" accept="image/*" onchange="previewImg(this)">

                        <div class="mt-2">
                            <small class="text-muted d-block mb-1">Preview Gambar:</small>
                            <?php
                            $currentImg = !empty($slider['image']) ? base_url($slider['image']) : base_url('assets/adminlte/assets/img/default-150x150.png');
                            ?>
                            <img id="prev" src="<?= $currentImg ?>" class="img-thumbnail shadow-sm" style="max-height: 200px;">
                        </div>
                        <small class="text-info">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="published" <?= $slider['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                            <option value="draft" <?= $slider['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <button type="submit" class="btn btn-warning fw-bold">Perbarui Slide</button>
                    <a href="<?= base_url('admin/slider') ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('prev');
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>