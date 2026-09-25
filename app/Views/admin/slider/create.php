<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="card card-primary card-outline w-75">
            <form action="<?= base_url('admin/slider/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Judul Slide</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi Singkat</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Link URL (Opsional)</label>
                        <input type="text" name="link_url" class="form-control" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label>Gambar Slide (Rekomendasi 1920x1080)</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required onchange="previewImg(this)">
                        <img id="prev" src="" class="img-thumbnail mt-2" style="max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('admin/slider') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function previewImg(i) {
        if (i.files && i.files[0]) {
            var r = new FileReader();
            r.onload = function(e) {
                var p = document.getElementById('prev');
                p.src = e.target.result;
                p.style.display = 'block';
            };
            r.readAsDataURL(i.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>