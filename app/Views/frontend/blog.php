<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Artikel</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="current">Artikel</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <section id="blog-posts" class="blog-posts section">
                <div class="container">
                    <div class="row gy-4">
                        <?php if ($posts): foreach ($posts as $p): ?>
                                <div class="col-lg-12">
                                    <article>
                                        <div class="post-img">
                                            <img src="<?= base_url((string)$p['featured_image']) ?>" alt="" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                                        </div>
                                        <h2 class="title">
                                            <a href="<?= base_url('blog/' . $p['slug']) ?>"><?= esc($p['title']) ?></a>
                                        </h2>
                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <span>Admin</span></li>
                                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <span><?= date('M d, Y', strtotime($p['created_at'])) ?></span></li>
                                            </ul>
                                        </div>
                                        <div class="content">
                                            <p><?= substr(strip_tags($p['content']), 0, 250) ?>...</p>
                                            <div class="read-more">
                                                <a href="<?= base_url('blog/' . $p['slug']) ?>">Baca selengkapnya</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach;
                        else: ?>
                            <p class="text-center">Tidak ada artikel ditemukan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <section id="blog-pagination" class="blog-pagination section">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <?= $pager->links('blog', 'default_full') ?>
                    </div>
                </div>
            </section>
        </div>

        <?= $this->include('frontend/blog_sidebar') ?>

    </div>
</div>

<?= $this->endSection() ?>