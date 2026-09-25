<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Services</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="current">Services</li>
            </ol>
        </nav>
    </div>
</div>

<section id="services" class="services section">
    <div class="container">
        <div class="row gy-4">
            <?php foreach ($services as $svc): ?>
                <div class="col-md-6" data-aos="fade-up">
                    <div class="service-item d-flex position-relative h-100">
                        <i class="<?= esc($svc['icon_class']) ?> icon flex-shrink-0 text-danger"></i>
                        <div>
                            <h4 class="title"><a href="<?= base_url('services/' . $svc['slug']) ?>" class="stretched-link"><?= esc($svc['title']) ?></a></h4>
                            <p class="description"><?= esc($svc['short_description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="features" class="features section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Fitur</h2>
        <p>Kapasitas & Kemampuan Kami</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                    <?php foreach ($services as $index => $svc): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $index === 0 ? 'active show' : '' ?>" data-bs-toggle="tab" href="#features-tab-<?= $svc['id'] ?>"><?= esc($svc['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content">
                    <?php foreach ($services as $index => $svc): ?>
                        <div class="tab-pane <?= $index === 0 ? 'active show' : '' ?>" id="features-tab-<?= $svc['id'] ?>">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3><?= esc($svc['title']) ?></h3>
                                    <p class="fst-italic"><?= esc($svc['short_description']) ?></p>
                                    <div class="mt-3">
                                        <?= $svc['content'] ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <?php $imgSvc = !empty($svc['image']) ? base_url($svc['image']) : base_url('frontend/assets/img/services.jpg'); ?>
                                    <img src="<?= $imgSvc ?>" alt="<?= esc($svc['title']) ?>" class="img-fluid rounded shadow">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>