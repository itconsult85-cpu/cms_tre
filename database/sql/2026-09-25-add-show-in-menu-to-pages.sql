-- Tambahkan pilihan halaman untuk ditampilkan pada menu navigasi.
-- Default 1 menjaga perilaku halaman lama agar tetap tampil di menu.
ALTER TABLE `pages`
    ADD COLUMN `show_in_menu` TINYINT(1) NOT NULL DEFAULT 1 AFTER `status`;

-- Contoh menyembunyikan halaman tertentu dari menu:
-- UPDATE `pages` SET `show_in_menu` = 0 WHERE `slug` = 'slug-halaman';
