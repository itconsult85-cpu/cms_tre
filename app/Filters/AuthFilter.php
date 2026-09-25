<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah ada session 'isLoggedIn'
        if (!session()->get('isLoggedIn')) {
            // Jika tidak ada, tendang kembali ke halaman login dengan pesan error
            return redirect()->to('/login')->with('error', 'Akses ditolak! Silakan login terlebih dahulu.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Biarkan kosong, kita tidak melakukan apa-apa setelah halaman dimuat
    }
}
