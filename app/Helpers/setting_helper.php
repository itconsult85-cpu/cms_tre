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
