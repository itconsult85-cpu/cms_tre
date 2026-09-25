<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="card card-warning card-outline mb-4 w-50">
            <form action="<?= base_url('admin/category/update/' . $category['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="<?= old('name', $category['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Digunakan Untuk (Tipe Konten) <span class="text-danger">*</span></label>
                        <select class="form-select" name="type" required>
                            <option value="post" <?= $category['type'] == 'post' ? 'selected' : '' ?>>Artikel / Blog (Post)</option>
                            <option value="portfolio" <?= $category['type'] == 'portfolio' ? 'selected' : '' ?>>Portofolio / Proyek (Portfolio)</option>
                            <option value="service" <?= $category['type'] == 'service' ? 'selected' : '' ?>>Layanan (Service)</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Perbarui Kategori</button>
                    <a href="<?= base_url('admin/category') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>