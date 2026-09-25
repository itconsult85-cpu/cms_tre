<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<section id="hero" class="hero section dark-background">
    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <?php if (!empty($sliders)): ?>
            <?php foreach ($sliders as $index => $slide): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= base_url($slide['image']) ?>" alt="<?= esc($slide['title']) ?>">
                    <div class="carousel-container">
                        <h2><?= esc($slide['title']) ?></h2>
                        <p><?= esc($slide['description']) ?></p>
                        <?php if (!empty($slide['link_url'])): ?>
                            <a href="<?= esc($slide['link_url']) ?>" class="btn-get-started">Read More</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="carousel-item active">
                <img src="<?= base_url('frontend/assets/img/hero-carousel/hero-carousel-1.jpg') ?>" alt="">
                <div class="carousel-container">
                    <h2>Welcome to <?= get_setting('nama_perusahaan') ?></h2>
                    <p>Silakan tambahkan gambar slider melalui CMS Admin.</p>
                </div>
            </div>
        <?php endif; ?>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>
    </div>
</section>

<section id="about" class="about section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Tentang</h2>
        <p>Profile Perusahaan</p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <p class="fw-bold fs-5">
                    PT. TRISENTOSA RAYA ESOLUSI adalah perusahaan Perseroan yang bergerak dibidang perdagangan (pengadaan barang dan jasa).
                </p>
                <ul>
                    <li><i class="bi bi-check2-circle text-danger"></i> <span>Kualitas Terjamin</span></li>
                    <li><i class="bi bi-check2-circle text-danger"></i> <span>Pengiriman Tepat Waktu</span></li>
                    <li><i class="bi bi-check2-circle text-danger"></i> <span>Pelayanan Sepenuh Hati</span></li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <p>Melalui Profil Perusahaan ini kami siap memberikan "Pelayanan Sepenuh Hati". Memenuhi kebutuhan pelanggan dengan jasa dan produk berkualitas, pelayanan yang cepat, tepat waktu, dapat dipercaya dan diandalkan serta bermutu.</p>
                <a href="<?= base_url('about') ?>" class="read-more"><span>Visi & Misi</span><i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<section id="clients" class="clients section light-background">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4 justify-content-center">
            <?php foreach ($clients as $client): ?>
                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="<?= base_url((string) $client['logo']) ?>" class="img-fluid" alt="<?= esc($client['name']) ?>" title="<?= esc($client['name']) ?>">
                </div>
            <?php endforeach; ?>
            <?php if (empty($clients)): ?>
                <p class="text-center text-muted">Logo Klien belum ditambahkan.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Layanan Kami</p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <?php foreach ($services as $svc): ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
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

<section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Portofolio</h2>
        <p>Proyek & Fasilitas</p>
    </div>
    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                <?php foreach ($portfolio_categories as $cat): ?>
                    <li data-filter=".filter-<?= esc($cat['slug']) ?>"><?= esc($cat['name']) ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($portfolios as $port): ?>

                    <?php
                    $coverImg = !empty($port['cover_image']) ? base_url($port['cover_image']) : base_url('frontend/assets/img/masonry-portfolio/masonry-portfolio-1.jpg');
                    ?>

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?= esc((string)$port['category_slug']) ?>">
                        <img src="<?= $coverImg ?>" class="img-fluid w-100" alt="<?= esc($port['title']) ?>" style="height: 250px; object-fit: cover;">
                        <div class="portfolio-info">
                            <h4><?= esc($port['title']) ?></h4>
                            <p><?= esc($port['client_name']) ?></p>

                            <a href="<?= $coverImg ?>" title="<?= esc($port['title']) ?>" data-gallery="portfolio-gallery-<?= esc((string)$port['category_slug']) ?>" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                            <a href="<?= base_url('portfolio/' . (string)$port['slug']) ?>" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>