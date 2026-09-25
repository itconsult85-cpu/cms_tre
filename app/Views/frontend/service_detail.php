<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0"><?= esc($service['title']) ?></h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li><a href="<?= base_url('services') ?>">Services</a></li>
                <li class="current">Details</li>
            </ol>
        </nav>
    </div>
</div>

<section id="service-details" class="service-details section">
    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="services-list shadow-sm rounded">
                    <?php foreach ($all_services as $s): ?>
                        <a href="<?= base_url('services/' . $s['slug']) ?>" class="<?= $s['slug'] == $service['slug'] ? 'active' : '' ?>">
                            <i class="<?= esc($s['icon_class']) ?> me-2"></i> <?= esc($s['title']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="help-box d-flex flex-column justify-content-center align-items-center mt-4 p-4 text-center bg-danger text-white rounded">
                    <i class="bi bi-headset help-icon mb-2 h1"></i>
                    <h4>Butuh Bantuan?</h4>
                    <p class="small">Hubungi tim ahli kami untuk konsultasi teknis pengadaan barang dan jasa.</p>
                    <p class="fw-bold mb-0"><?= get_setting('telepon_kantor') ?></p>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <?php $imgDetail = !empty($service['image']) ? base_url($service['image']) : base_url('frontend/assets/img/services.jpg'); ?>
                <img src="<?= $imgDetail ?>" alt="<?= esc($service['title']) ?>" class="img-fluid services-img rounded shadow mb-4 w-100" style="max-height: 400px; object-fit: cover;">

                <h2 class="text-danger fw-bold"><?= esc($service['title']) ?></h2>
                <div class="mt-4">
                    <?= $service['content'] ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>