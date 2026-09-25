<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/client/update/' . $client['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">Klien</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nama Klien <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?= old('name', $client['name']) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-secondary mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Urutan Tampil (Sort Order)</label>
                                <input type="number" class="form-control" name="sort_order" value="<?= old('sort_order', $client['sort_order']) ?>" min="0">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option value="published" <?= $client['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                                    <option value="draft" <?= $client['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                                </select>
                            </div>
                            <hr>
                            <div class="mb-3 text-center">
                                <label class="d-block text-start">Logo Klien Baru <small>(Kosongkan jika tidak diubah)</small></label>
                                <?php $imgSrc = !empty($client['image']) ? base_url($client['image']) : base_url('assets/adminlte/assets/img/default-150x150.png'); ?>
                                <img id="img_preview" src="<?= $imgSrc ?>" class="rounded-circle border mb-3 mt-2" style="width: 150px; height: 150px; object-fit: cover;">
                                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(this)">
                            </div>

                            <button type="submit" class="btn btn-warning w-100 mt-2">Perbarui Klien</button>
                            <a href="<?= base_url('admin/client') ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
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