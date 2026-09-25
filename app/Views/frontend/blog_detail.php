<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Artikel Details</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li><a href="<?= base_url('blog') ?>">Artikel</a></li>
                <li class="current">Details</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <section id="blog-details" class="blog-details section">
                <div class="container">
                    <article class="article">
                        <div class="post-img">
                            <img src="<?= base_url((string)$post['featured_image']) ?>" alt="" class="img-fluid rounded w-100">
                        </div>
                        <h2 class="title"><?= esc($post['title']) ?></h2>
                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <span>Admin</span></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <span><?= date('M d, Y', strtotime($post['created_at'])) ?></span></li>
                            </ul>
                        </div>
                        <div class="content">
                            <?= $post['content'] ?>
                        </div>
                    </article>
                </div>
            </section>
        </div>

        <?= $this->include('frontend/blog_sidebar') ?>
    </div>
</div>

<?= $this->endSection() ?>