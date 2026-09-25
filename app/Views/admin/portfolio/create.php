<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/portfolio/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">Detail Proyek</h5>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label>Nama Proyek / Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="<?= old('title') ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama Klien</label>
                                    <input type="text" class="form-control" name="client_name" value="<?= old('client_name') ?>" placeholder="Misal: PT. Angkasa Raya">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>URL Proyek / Website</label>
                                    <input type="url" class="form-control" name="project_url" value="<?= old('project_url') ?>" placeholder="https://...">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Deskripsi Proyek</label>
                                <textarea class="form-control tinymce-editor" name="description" rows="10"><?= old('description') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0"><i class="bi bi-images me-1"></i> Galeri Proyek (Multiple Images)</h5>
                        </div>
                        <div class="card-body">
                            <label>Pilih Banyak Gambar Sekaligus</label>
                            <input type="file" class="form-control" name="gallery_images[]" accept="image/*" multiple>
                            <small class="text-muted">Anda dapat memilih lebih dari 1 gambar dengan menekan tombol CTRL saat memilih file.</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-secondary mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Kategori (Penting untuk Filter) <span class="text-danger">*</span></label>
                                <select class="form-select" name="category_id" required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= esc($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Tanggal Proyek</label>
                                <input type="date" class="form-control" name="project_date" value="<?= old('project_date') ?>">
                            </div>

                            <div class="mb-3">
                                <label>Status Tayang</label>
                                <select class="form-select" name="status">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>

                            <hr>
                            <div class="mb-3">
                                <label>Gambar Cover (Utama)</label>
                                <input type="file" class="form-control mb-2" name="cover_image" accept="image/*" onchange="previewImage(this)">
                                <img id="img_preview" src="" class="img-thumbnail mt-2" style="max-height: 150px; display: none;">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan Portofolio</button>
                            <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
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