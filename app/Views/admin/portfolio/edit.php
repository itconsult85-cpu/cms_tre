<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/portfolio/update/' . $portfolio['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nama Proyek</label>
                                <input type="text" class="form-control" name="title" value="<?= old('title', $portfolio['title']) ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama Klien</label>
                                    <input type="text" class="form-control" name="client_name" value="<?= old('client_name', $portfolio['client_name']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>URL Proyek</label>
                                    <input type="url" class="form-control" name="project_url" value="<?= old('project_url', $portfolio['project_url']) ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi Proyek</label>
                                <textarea class="form-control tinymce-editor" name="description" rows="10"><?= old('description', $portfolio['description']) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0"><i class="bi bi-images me-1"></i> Galeri Proyek</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($galleries)): ?>
                                <label class="mb-2">Gambar Saat Ini (Centang untuk menghapus)</label>
                                <div class="row mb-4">
                                    <?php foreach ($galleries as $gal): ?>
                                        <div class="col-md-3 col-sm-4 text-center mb-3">
                                            <img src="<?= base_url((string)$gal['file_path']) ?>" class="img-thumbnail mb-2" style="height: 100px; object-fit: cover; width: 100%;">
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input border-danger me-2" type="checkbox" name="delete_gallery[]" value="<?= $gal['id'] ?>" id="del_<?= $gal['id'] ?>">
                                                <label class="form-check-label text-danger small" for="del_<?= $gal['id'] ?>">Hapus Gambar</label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <hr>
                            <?php endif; ?>

                            <label>Tambahkan Gambar Baru</label>
                            <input type="file" class="form-control" name="gallery_images[]" accept="image/*" multiple>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-secondary mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Kategori</label>
                                <select class="form-select" name="category_id" required>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= $portfolio['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Tanggal Proyek</label>
                                <input type="date" class="form-control" name="project_date" value="<?= old('project_date', $portfolio['project_date']) ?>">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select class="form-select" name="status">
                                    <option value="published" <?= $portfolio['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                                    <option value="draft" <?= $portfolio['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                                </select>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label>Cover Baru <small>(Abaikan jika tidak diubah)</small></label>
                                <input type="file" class="form-control mb-2" name="cover_image" accept="image/*" onchange="previewImage(this)">
                                <?php $display = !empty((string)$portfolio['cover_image']) ? 'block' : 'none'; ?>
                                <img id="img_preview" src="<?= base_url((string)$portfolio['cover_image']) ?>" class="img-thumbnail mt-2" style="max-height: 150px; display: <?= $display ?>;">
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Perbarui Portofolio</button>
                            <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>