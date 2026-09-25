<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0"><?= esc($page['title']) ?></h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="current"><?= esc($page['title']) ?></li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if (!empty($page['featured_image'])): ?>
                    <div class="mb-4 text-center">
                        <img src="<?= base_url($page['featured_image']) ?>" alt="<?= esc($page['title']) ?>" class="img-fluid rounded">
                    </div>
                <?php endif; ?>

                <article class="content">
                    <?= $page['content'] ?? '' ?>
                </article>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
