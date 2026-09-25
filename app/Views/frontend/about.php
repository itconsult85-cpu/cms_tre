<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Tentang Kami</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="current">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>
<section id="about-2" class="about-2 section">
    <div class="container" data-aos="fade-up">
        <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-5">
                <div class="about-img">
                    <?php
                    $imgProfile = !empty($profile['featured_image']) ? base_url($profile['featured_image']) : base_url('frontend/assets/img/about-portrait.jpg');
                    ?>
                    <img src="<?= $imgProfile ?>" class="img-fluid rounded shadow" alt="Profil Perusahaan">
                </div>
            </div>

            <div class="col-lg-7">
                <h3 class="pt-0 pt-lg-3 text-danger fw-bold"><?= get_setting('nama_perusahaan') ?? 'PT. TRISENTOSA RAYA ESOLUSI' ?></h3>
                <p class="fst-italic text-muted mb-4">"Pelayanan Sepenuh Hati, Tepat Waktu, dan Bermutu Tinggi."</p>

                <ul class="nav nav-pills mb-3">
                    <li><a class="nav-link active" data-bs-toggle="pill" href="#tab-profile">Profil Perusahaan</a></li>
                    <li><a class="nav-link" data-bs-toggle="pill" href="#tab-visimisi">Visi & Misi</a></li>
                </ul>

                <div class="tab-content mt-4">
                    <div class="tab-pane fade show active" id="tab-profile">
                        <?= $profile['content'] ?? '<p>Konten profil belum ditambahkan di CMS.</p>' ?>
                    </div>

                    <div class="tab-pane fade" id="tab-visimisi">
                        <?= $visimisi['content'] ?? '<p>Konten visi misi belum ditambahkan di CMS.</p>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>