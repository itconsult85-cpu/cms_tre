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
            <form action="<?= base_url('admin/setting/update/' . $setting['id']) ?>" method="post" enctype="multipart/form-data"> <?= csrf_field() ?>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label>Setting Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="setting_key" value="<?= old('setting_key', $setting['setting_key']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Tipe Input <span class="text-danger">*</span></label>
                        <select class="form-select" name="setting_type" id="setting_type" onchange="toggleInput()" required>
                            <option value="text" <?= $setting['setting_type'] == 'text' ? 'selected' : '' ?>>Teks Pendek (Text)</option>
                            <option value="textarea" <?= $setting['setting_type'] == 'textarea' ? 'selected' : '' ?>>Teks Panjang (Textarea)</option>
                            <option value="url" <?= $setting['setting_type'] == 'url' ? 'selected' : '' ?>>Tautan (URL)</option>
                            <option value="image" <?= $setting['setting_type'] == 'image' ? 'selected' : '' ?>>Gambar (Image)</option>
                        </select>
                    </div>
                    <div class="mb-3" id="text_input_area">
                        <label>Value / Nilai</label>
                        <textarea class="form-control" name="setting_value" rows="3"><?= old('setting_value', $setting['setting_value']) ?></textarea>
                    </div>
                    <div class="mb-3" id="image_input_area" style="display: none;">
                        <label>Upload Gambar Baru <small>(Biarkan kosong jika tidak diubah)</small></label>
                        <input type="file" class="form-control mb-2" name="setting_image" accept="image/*" onchange="previewImage(this)">

                        <?php
                        $imageSrc = '';
                        $displayStyle = 'none';
                        if ($setting['setting_type'] == 'image' && !empty($setting['setting_value'])) {
                            $imageSrc = base_url($setting['setting_value']);
                            $displayStyle = 'block';
                        }
                        ?>
                        <img id="img_preview" src="<?= $imageSrc ?>" alt="Preview" class="img-thumbnail mt-2 shadow-sm" style="max-height: 150px; display: <?= $displayStyle ?>; border-radius: 8px;">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="description" value="<?= old('description', $setting['description']) ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                    <a href="<?= base_url('admin/setting') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    function toggleInput() {
        var type = document.getElementById('setting_type').value;
        var textArea = document.getElementById('text_input_area');
        var imageArea = document.getElementById('image_input_area');

        if (type === 'image') {
            textArea.style.display = 'none';
            imageArea.style.display = 'block';
        } else {
            textArea.style.display = 'block';
            imageArea.style.display = 'none';
        }
    }

    // Fungsi untuk Live Preview Gambar Baru yang menimpa Preview Gambar Lama
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

    window.onload = toggleInput;
</script>
<?= $this->endSection() ?>