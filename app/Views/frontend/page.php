<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<section class="page-title" data-aos="fade-up">
    <div class="container">
        <h1><?= esc($page['title']) ?></h1>
    </div>
</section>

<section class="section">
    <div class="container" data-aos="fade-up">
        <?php if (!empty($page['featured_image'])): ?>
            <div class="mb-4 text-center">
                <img src="<?= base_url($page['featured_image']) ?>" alt="<?= esc($page['title']) ?>" class="img-fluid rounded">
            </div>
        <?php endif; ?>

        <article class="content">
            <?= $page['content'] ?? '' ?>
        </article>
    </div>
</section>

<?= $this->endSection() ?>
