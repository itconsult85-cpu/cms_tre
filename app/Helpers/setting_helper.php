<?php

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        // Variabel statis untuk menyimpan data agar tidak query DB berulang kali
        static $settings = null;

        if ($settings === null) {
            $db = \Config\Database::connect();
            $results = $db->table('settings')->get()->getResultArray();

            $settings = [];
            foreach ($results as $row) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }

        return $settings[$key] ?? null; // Kembalikan nilai, atau null jika key tidak ditemukan
    }
}

if (!function_exists('get_published_pages')) {
    /**
     * Return published CMS pages that can be shown in the public navigation.
     * Legacy pages used by the About page are intentionally excluded to avoid
     * duplicate navigation entries.
     */
    function get_published_pages(): array
    {
        static $pages = null;

        if ($pages === null) {
            $pages = (new \App\Models\PageModel())
                ->where('status', 'published')
                ->where('show_in_menu', 1)
                ->whereNotIn('slug', ['profile-perusahaan', 'visi-misi'])
                ->orderBy('title', 'ASC')
                ->findAll();
        }

        return $pages;
    }
}
