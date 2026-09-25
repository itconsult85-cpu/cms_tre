<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Kontak</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="current">Kontak</li>
            </ol>
        </nav>
    </div>
</div>
<section id="contact" class="contact section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
            <?php
            $maps = get_setting('google_maps_iframe');
            if (strpos($maps, '<iframe') !== false) {
                echo $maps;
            } else {
                echo '<iframe style="border:0; width: 100%; height: 270px;" src="' . esc($maps) . '" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
            }
            ?>
        </div>
        <div class="row gy-4">

            <div class="col-lg-4">
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h3>Alamat</h3>
                        <p><?= nl2br(esc(get_setting('alamat_workshop'))) ?></p>
                    </div>
                </div>
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>Telepon</h3>
                        <p><?= get_setting('telepon_kantor') ?></p>
                    </div>
                </div>
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>e-Mail</h3>
                        <p><?= get_setting('email_perusahaan') ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <form action="<?= base_url('contact/send') ?>" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    <?= csrf_field() ?>
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="<?= old('name') ?>" required="">
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="e-Mail Anda" value="<?= old('email') ?>" required="">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subjek" value="<?= old('subject') ?>" required="">
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required=""><?= old('message') ?></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="sent-message d-block"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="error-message d-block"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <button type="submit">Kirim Pesan</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section><?= $this->endSection() ?>