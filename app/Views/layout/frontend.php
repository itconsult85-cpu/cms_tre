<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= esc($title) ?></title>
    <meta name="description" content="<?= get_setting('meta_description') ?? '' ?>">

    <link href="<?= base_url('frontend/assets/img/tre.png') ?>" rel="icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="<?= base_url('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('frontend/assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('frontend/assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('frontend/assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('frontend/assets/css/main.css') ?>" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="<?= base_url('/') ?>" class="logo d-flex align-items-center me-auto">
                <?php if (!empty($logo)): ?>
                    <img src="<?= base_url($logo) ?>" alt="Logo Perusahaan">
                <?php else: ?>
                    <h1 class="sitename"><?= get_setting('nama_perusahaan') ?? 'TRE' ?></h1>
                <?php endif; ?>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="<?= base_url('/') ?>" class="<?= (url_is('/') || url_is('home*')) ? 'active' : '' ?>">Beranda</a>
                    </li>

                    <li>
                        <a href="<?= base_url('about') ?>" class="<?= (url_is('about*')) ? 'active' : '' ?>">Tentang</a>
                    </li>

                    <li>
                        <a href="<?= base_url('services') ?>" class="<?= (url_is('services*')) ? 'active' : '' ?>">Services</a>
                    </li>

                    <li>
                        <a href="<?= base_url('portfolio') ?>" class="<?= (url_is('portfolio*')) ? 'active' : '' ?>">Portofolio</a>
                    </li>

                    <li>
                        <a href="<?= base_url('blog') ?>" class="<?= (url_is('blog*')) ? 'active' : '' ?>">Artikel</a>
                    </li>

                    <li>
                        <a href="<?= base_url('contact') ?>" class="<?= (url_is('contact*')) ? 'active' : '' ?>">Kontak</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="<?= base_url('contact') ?>">Memulai</a>
        </div>
    </header>

    <main class="main">
        <?= $this->renderSection('content') ?>
    </main>

    <footer id="footer" class="footer dark-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-6 footer-about">
                    <a href="<?= base_url('/') ?>" class="logo d-flex align-items-center">
                        <span class="sitename"><?= get_setting('nama_perusahaan') ?? 'TRE' ?></span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p><?= nl2br(esc(get_setting('alamat_workshop'))) ?></p>
                        <p class="mt-3"><strong>Phone:</strong> <span><?= get_setting('kontak_whatsapp') ?></span></p>
                        <p><strong>Email:</strong> <span><?= get_setting('email_perusahaan') ?></span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="<?= get_setting('link_twitter') ?? '#' ?>"><i class="bi bi-twitter-x"></i></a>
                        <a href="<?= get_setting('link_facebook') ?? '#' ?>"><i class="bi bi-facebook"></i></a>
                        <a href="<?= get_setting('link_instagram') ?? '#' ?>"><i class="bi bi-instagram"></i></a>
                        <a href="<?= get_setting('link_linkedin') ?? '#' ?>"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 footer-links">
                    <h4>Tautan Berguna</h4>
                    <ul>
                        <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                        <li><a href="<?= base_url('about') ?>">Tentang</a></li>
                        <li><a href="<?= base_url('services') ?>">Services</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="#">Machining</a></li>
                        <li><a href="#">Fabrication</a></li>
                        <li><a href="#">Trading</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Hak Cipta</span> <strong class="px-1 sitename"><?= get_setting('nama_perusahaan') ?? 'TRE' ?></strong> <span>Semua Hak Dilindungi Undang-Undang</span></p>
        </div>
    </footer>

    <?php
    $wa_number = get_setting('kontak_whatsapp');
    $wa_clean = preg_replace('/[^0-9]/', '', (string)$wa_number);
    ?>
    <a href="https://wa.me/<?= $wa_clean ?>?text=Halo%20PT.%20TRE,%20saya%20tertarik%20dengan%20layanan%20Anda."
        class="whatsapp-float"
        target="_blank"
        title="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>
    <div id="preloader"></div>
    <script src="<?= base_url('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/vendor/aos/aos.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/vendor/waypoints/noframework.waypoints.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>

    <script src="<?= base_url('frontend/assets/js/main.js') ?>"></script>

</body>

</html>