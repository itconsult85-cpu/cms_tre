<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalasi CMS | KOKUO Group</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        body {
            /* Ubah gradasi menjadi kombinasi Hitam - Merah Gelap - Merah Maroon */
            background: linear-gradient(135deg, #0a0000, #3a0000, #6b0000);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }

        .setup-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            /* Sedikit ditebalkan shadow-nya */
            padding: 40px;
            width: 100%;
            max-width: 450px;
            color: white;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ff4d4d;
            /* Warna merah terang saat input diklik */
            color: white;
            box-shadow: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-setup {
            /* Gradasi merah pada tombol */
            background: linear-gradient(45deg, #a70000, #ff1a1a);
            border: none;
            font-weight: bold;
            padding: 12px;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #ffffff;
            /* Ubah teks tombol jadi putih */
        }

        .btn-setup:hover {
            transform: translateY(-3px);
            color: #ffffff;
            box-shadow: 0 5px 15px rgba(255, 26, 26, 0.4);
            /* Efek glow merah saat di-hover */
        }
    </style>
</head>

<body>

    <div class="setup-card">
        <div class="text-center mb-4">
            <h2 class="fw-bold"><i class="bi bi-hexagon-fill text-danger"></i> KOKUO</h2>
            <p class="text-white-50">Instalasi CMS Pertama Kali</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger bg-danger text-white border-0 py-2 small">
                <i class="bi bi-exclamation-triangle-fill"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('setup/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label text-white-50 small mb-1">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-white"><i class="bi bi-person-vcard"></i></span>
                    <input type="text" name="name" class="form-control border-start-0" value="<?= old('name') ?>" placeholder="Nama pengelola" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-white-50 small mb-1">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-white"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control border-start-0" value="<?= old('email') ?>" placeholder="Email aktif" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-white-50 small mb-1">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-white"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control border-start-0" value="<?= old('username') ?>" placeholder="Tanpa spasi" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-white-50 small mb-1">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-white"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control border-start-0" placeholder="Minimal 6 karakter" required minlength="6">
                </div>
            </div>

            <button type="submit" class="btn btn-setup w-100"><i class="bi bi-rocket-takeoff me-1"></i> INSTALL CMS</button>
        </form>
    </div>

</body>

</html>