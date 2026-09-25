<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Portofolio</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="current">Portofolio</li>
            </ol>
        </nav>
    </div>
</div>

<section id="portfolio" class="portfolio section">
    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">Semua</li>
                <?php foreach ($categories as $cat): ?>
                    <li data-filter=".filter-<?= esc($cat['slug']) ?>"><?= esc($cat['name']) ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($portfolios as $port): ?>
                    <?php $cover = !empty($port['cover_image']) ? base_url($port['cover_image']) : base_url('frontend/assets/img/masonry-portfolio/masonry-portfolio-1.jpg'); ?>

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?= esc((string)$port['category_slug']) ?>">
                        <img src="<?= $cover ?>" class="img-fluid w-100" alt="<?= esc($port['title']) ?>" style="height: 300px; object-fit: cover;">
                        <div class="portfolio-info">
                            <h4><?= esc($port['title']) ?></h4>
                            <p><?= esc($port['client_name']) ?? 'General Project' ?></p>
                            <a href="<?= $cover ?>" title="<?= esc($port['title']) ?>" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            <a href="<?= base_url('portfolio/' . $port['slug']) ?>" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>