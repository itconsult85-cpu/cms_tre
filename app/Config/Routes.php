<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/services', 'Home::services');
$routes->get('/services/(:segment)', 'Home::service_detail/$1');
$routes->get('/portfolio', 'Home::portfolio');
$routes->get('/portfolio/(:segment)', 'Home::portfolio_detail/$1');
$routes->get('/contact', 'Home::contact');
$routes->post('/contact/send', 'Home::send_message');
$routes->get('blog', 'Home::blog');
$routes->get('blog/(:segment)', 'Home::blog_detail/$1');

$routes->post('kontak/kirim', 'Home::simpanPesan');

// ==========================================
// 2. ROUTING BACKEND & AUTHENTICATION
// ==========================================
// Setup Instalasi CMS
$routes->get('/setup', 'Setup::index');
$routes->post('/setup/store', 'Setup::store');

// Login System
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/login/logout', 'Login::logout');

// Manajemen User (Dari yang kita buat di awal percakapan)
// Nanti kita bisa bungkus rute /admin ini dengan Filter keamanan
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    // Semua rute di dalam ini sekarang AMAN dari akses tanpa login
    $routes->get('user', 'Admin\User::index');
    $routes->get('user/create', 'Admin\User::create');
    $routes->post('user/store', 'Admin\User::store');
    $routes->get('user/edit/(:num)', 'Admin\User::edit/$1');
    $routes->post('user/update/(:num)', 'Admin\User::update/$1');
    $routes->post('user/delete/(:num)', 'Admin\User::delete/$1');

    // Rute Pengaturan
    $routes->get('setting', 'Admin\Setting::index');
    $routes->get('setting/create', 'Admin\Setting::create');
    $routes->post('setting/store', 'Admin\Setting::store');
    $routes->get('setting/edit/(:num)', 'Admin\Setting::edit/$1');
    $routes->post('setting/update/(:num)', 'Admin\Setting::update/$1');
    $routes->post('setting/delete/(:num)', 'Admin\Setting::delete/$1');

    // Rute Modul Slider
    $routes->get('slider', 'Admin\Slider::index');
    $routes->get('slider/create', 'Admin\Slider::create');
    $routes->post('slider/store', 'Admin\Slider::store');
    $routes->get('slider/edit/(:num)', 'Admin\Slider::edit/$1');
    $routes->post('slider/update/(:num)', 'Admin\Slider::update/$1');
    $routes->post('slider/delete/(:num)', 'Admin\Slider::delete/$1');

    //Rute Page
    $routes->get('page', 'Admin\Page::index');
    $routes->get('page/create', 'Admin\Page::create');
    $routes->post('page/store', 'Admin\Page::store');
    $routes->get('page/edit/(:num)', 'Admin\Page::edit/$1');
    $routes->post('page/update/(:num)', 'Admin\Page::update/$1');
    $routes->post('page/delete/(:num)', 'Admin\Page::delete/$1');

    //Rute Category
    $routes->get('category', 'Admin\Category::index');
    $routes->get('category/create', 'Admin\Category::create');
    $routes->post('category/store', 'Admin\Category::store');
    $routes->get('category/edit/(:num)', 'Admin\Category::edit/$1');
    $routes->post('category/update/(:num)', 'Admin\Category::update/$1');
    $routes->post('category/delete/(:num)', 'Admin\Category::delete/$1');

    //Rute Post
    $routes->get('post', 'Admin\Post::index');
    $routes->get('post/create', 'Admin\Post::create');
    $routes->post('post/store', 'Admin\Post::store');
    $routes->get('post/edit/(:num)', 'Admin\Post::edit/$1');
    $routes->post('post/update/(:num)', 'Admin\Post::update/$1');
    $routes->post('post/delete/(:num)', 'Admin\Post::delete/$1');

    //Rute Portfolio
    $routes->get('portfolio', 'Admin\Portfolio::index');
    $routes->get('portfolio/create', 'Admin\Portfolio::create');
    $routes->post('portfolio/store', 'Admin\Portfolio::store');
    $routes->get('portfolio/edit/(:num)', 'Admin\Portfolio::edit/$1');
    $routes->post('portfolio/update/(:num)', 'Admin\Portfolio::update/$1');
    $routes->post('portfolio/delete/(:num)', 'Admin\Portfolio::delete/$1');

    //Rute Services
    $routes->get('service', 'Admin\Service::index');
    $routes->get('service/create', 'Admin\Service::create');
    $routes->post('service/store', 'Admin\Service::store');
    $routes->get('service/edit/(:num)', 'Admin\Service::edit/$1');
    $routes->post('service/update/(:num)', 'Admin\Service::update/$1');
    $routes->post('service/delete/(:num)', 'Admin\Service::delete/$1');

    //Rute Team
    $routes->get('team', 'Admin\Team::index');
    $routes->get('team/create', 'Admin\Team::create');
    $routes->post('team/store', 'Admin\Team::store');
    $routes->get('team/edit/(:num)', 'Admin\Team::edit/$1');
    $routes->post('team/update/(:num)', 'Admin\Team::update/$1');
    $routes->post('team/delete/(:num)', 'Admin\Team::delete/$1');

    // Backend Route (Di dalam group 'admin')
    $routes->get('message', 'Admin\Message::index');
    $routes->get('message/read/(:num)', 'Admin\Message::read/$1');
    $routes->post('message/reply/(:num)', 'Admin\Message::reply/$1');
    $routes->post('message/delete/(:num)', 'Admin\Message::delete/$1');

    //Rute Client
    $routes->get('client', 'Admin\Client::index');
    $routes->get('client/create', 'Admin\Client::create');
    $routes->post('client/store', 'Admin\Client::store');
    $routes->get('client/edit/(:num)', 'Admin\Client::edit/$1');
    $routes->post('client/update/(:num)', 'Admin\Client::update/$1');
    $routes->post('client/delete/(:num)', 'Admin\Client::delete/$1');
});
