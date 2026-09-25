<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>

<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= esc($title); ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="<?= base_url('admin/page/update/' . $page['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-body">

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label>Judul Halaman <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="<?= old('title', $page['title']) ?>" required>
                                <small class="text-muted d-block mt-1">URL saat ini: <code>/<?= esc($page['slug']) ?></code> <br><em>(URL otomatis berubah jika Anda mengubah judul).</em></small>
                            </div>

                            <div class="mb-3">
                                <label>Konten Halaman</label>
                                <textarea class="form-control tinymce-editor" name="content" rows="20"><?= old('content', $page['content']) ?></textarea>
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
                                    <option value="published" <?= $page['status'] === 'published' ? 'selected' : '' ?>>Published (Tayang)</option>
                                    <option value="draft" <?= $page['status'] === 'draft' ? 'selected' : '' ?>>Draft (Simpan Sementara)</option>
                                </select>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="show_in_menu" value="1" id="show_in_menu" <?= old('show_in_menu', $page['show_in_menu'] ?? 1) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="show_in_menu">Tampilkan di menu navigasi</label>
                            </div>

                            <div class="mb-3">
                                <label>Gambar Utama (Featured Image)</label>
                                <input type="file" class="form-control mb-2" name="featured_image" accept="image/*" onchange="previewImage(this)">

                                <?php
                                $imageSrc = '';
                                $displayStyle = 'none';
                                if (!empty($page['featured_image'])) {
                                    $imageSrc = base_url($page['featured_image']);
                                    $displayStyle = 'block';
                                }
                                ?>
                                <img id="img_preview" src="<?= $imageSrc ?>" class="img-thumbnail mt-2 shadow-sm" style="max-height: 200px; display: <?= $displayStyle ?>; border-radius: 8px;">
                                <?php if (!empty($page['featured_image'])): ?>
                                    <small id="img_note" class="text-muted d-block mt-1">Ini adalah gambar Anda saat ini. Pilih file baru untuk menggantinya.</small>
                                <?php endif; ?>
                            </div>

                            <hr class="text-muted">

                            <h6 class="fw-bold mb-3"><i class="bi bi-google me-1 text-primary"></i> Pengaturan SEO</h6>

                            <div class="mb-3">
                                <label>Meta Title <small class="text-muted">(Opsional)</small></label>
                                <input type="text" class="form-control" name="meta_title" value="<?= old('meta_title', $page['meta_title']) ?>" placeholder="Maks. 60 karakter">
                            </div>

                            <div class="mb-4">
                                <label>Meta Description <small class="text-muted">(Opsional)</small></label>
                                <textarea class="form-control" name="meta_description" rows="4" placeholder="Maks. 160 karakter untuk pencarian Google..."><?= old('meta_description', $page['meta_description']) ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-warning fw-bold w-100 mb-2"><i class="bi bi-save me-1"></i> Perbarui Halaman</button>
                            <a href="<?= base_url('admin/page') ?>" class="btn btn-outline-secondary w-100">Batal</a>

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
    // Inisialisasi TinyMCE (WYSIWYG Editor)
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template help',
        toolbar_mode: 'sliding',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor emoticons | removeformat help',
        menubar: 'file edit view insert format tools table help',
        height: 500, // Tinggi area ketik yang lebih lega
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        // Optional: Anda bisa menambahkan logika upload gambar langsung di dalam TinyMCE jika diperlukan nanti
    });

    // Fungsi Live Preview untuk Featured Image
    function previewImage(input) {
        var preview = document.getElementById('img_preview');
        var note = document.getElementById('img_note'); // Tag catatan gambar lama (jika ada)

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';

                // Ubah teks catatan jika gambar berhasil di-load
                if (note) {
                    note.innerHTML = '<span class="text-success"><i class="bi bi-check-circle"></i> Preview gambar baru yang akan disimpan.</span>';
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>
