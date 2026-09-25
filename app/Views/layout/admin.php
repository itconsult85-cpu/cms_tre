<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) . ' | TRE Group CMS' : 'TRE Group CMS' ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">

    <?= $this->renderSection('styles') ?>
</head>

<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <span class="d-none d-md-inline"><?= session()->get('name') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-danger">
                                <i class="bi bi-person-circle display-4"></i>
                                <p>
                                    <?= session()->get('name') ?>
                                    <small><?= ucfirst(session()->get('role')) ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="<?= base_url('login/logout') ?>" class="btn btn-default btn-flat float-end text-danger"><i class="bi bi-box-arrow-right"></i> Keluar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar bg-dark shadow-sm" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="<?= base_url('admin/user') ?>" class="brand-link text-decoration-none">
                    <span class="brand-text fw-bold"><i class="bi bi-hexagon-fill text-danger"></i> TRE</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">PENGATURAN</li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/user') ?>" class="nav-link <?= (url_is('admin/user*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Manajemen Akun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/setting') ?>" class="nav-link <?= (url_is('admin/setting*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-gear-fill"></i>
                                <p>Pengaturan Web</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/page') ?>" class="nav-link <?= (url_is('admin/page*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-file-earmark-text-fill"></i>
                                <p>Halaman Web</p>
                            </a>
                        </li>
                        <li class="nav-header">KONTEN</li>

                        <li class="nav-item">
                            <a href="<?= base_url('admin/slider') ?>" class="nav-link <?= (url_is('admin/slider*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-images"></i>
                                <p>Carousel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/category') ?>" class="nav-link <?= (url_is('admin/category*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-tags-fill"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/post') ?>" class="nav-link <?= (url_is('admin/post*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-newspaper"></i>
                                <p>Artikel / Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/portfolio') ?>" class="nav-link <?= (url_is('admin/portfolio*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-briefcase-fill"></i>
                                <p>Portofolio / Proyek</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/service') ?>" class="nav-link <?= (url_is('admin/service*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-hdd-network-fill"></i>
                                <p>Layanan Kami</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/team') ?>" class="nav-link <?= (url_is('admin/team*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-person-badge-fill"></i>
                                <p>Tim Kami</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/message') ?>" class="nav-link <?= (url_is('admin/message*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-envelope-paper-fill"></i>
                                <p>Pesan Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/client') ?>" class="nav-link <?= (url_is('admin/client*')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-buildings-fill"></i>
                                <p>Klien / Mitra</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="app-main">
            <?= $this->renderSection('content') ?>
        </main>

        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">CMS Version 1.0</div>
            <strong>Copyright &copy; <?= date('Y') ?> KOKUO Group.</strong> All rights reserved.
        </footer>
    </div>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/adminlte/js/adminlte.min.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>