<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Portofolio Details</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li><a href="<?= base_url('portfolio') ?>">Portofolio</a></li>
                <li class="current">Details</li>
            </ol>
        </nav>
    </div>
</div>

<section id="portfolio-details" class="portfolio-details section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">

                        <?php if (!empty($portfolio['cover_image'])): ?>
                            <div class="swiper-slide">
                                <a href="<?= base_url((string)$portfolio['cover_image']) ?>" class="glightbox" data-gallery="portfolio-detail-gallery">
                                    <img src="<?= base_url((string)$portfolio['cover_image']) ?>" alt="Cover Proyek" class="img-fluid w-100" style="height: 450px; object-fit: cover; border-radius: 8px;">
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($galleries)): ?>
                            <?php foreach ($galleries as $gal): ?>
                                <?php
                                $pathGaleri = $gal['file_path'] ?? $gal['image'] ?? $gal['file'];
                                ?>
                                <div class="swiper-slide">
                                    <a href="<?= base_url((string)$pathGaleri) ?>" class="glightbox" data-gallery="portfolio-detail-gallery">
                                        <img src="<?= base_url((string)$pathGaleri) ?>" alt="Galeri Proyek" class="img-fluid w-100" style="height: 450px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                    <h3>Project Information</h3>
                    <ul>
                        <li><strong>Kategori</strong>: <?= esc($category['name'] ?? '-') ?></li>
                        <li><strong>Klien</strong>: <?= esc($portfolio['client_name']) ?: '-' ?></li>
                        <li><strong>Project date</strong>: <?= !empty($portfolio['project_date']) ? date('d M, Y', strtotime($portfolio['project_date'])) : '-' ?></li>
                        <li><strong>Project URL</strong>:
                            <?php if (!empty($portfolio['project_url'])): ?>
                                <a href="<?= esc($portfolio['project_url']) ?>" target="_blank">Kunjungi Situs</a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
                <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                    <h2><?= esc($portfolio['title']) ?></h2>
                    <div class="mt-3">
                        <?= $portfolio['description']
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>