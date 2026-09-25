<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\PortfolioModel;
use App\Models\CategoryModel;
use App\Models\ClientModel;
use App\Models\SettingModel;
use \App\Models\SliderModel;

class Home extends BaseController
{
    public function index(): string
    {
        $serviceModel   = new ServiceModel();
        $portfolioModel = new PortfolioModel();
        $categoryModel  = new CategoryModel();
        $clientModel    = new ClientModel();
        $sliderModel    = new SliderModel();
        $settingModel    = new SettingModel();

        $data = [
            'title'                => get_setting('nama_perusahaan') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
            'services'             => $serviceModel->where('status', 'published')->findAll(6),
            'clients'              => $clientModel->where('status', 'published')->orderBy('sort_order', 'ASC')->findAll(),
            'portfolio_categories' => $categoryModel->where('type', 'portfolio')->findAll(),
            'sliders'              => $sliderModel->where('status', 'published')->findAll(),
            'portfolios'           => $portfolioModel->where('portfolios.status', 'published')->getAllPortfolios(),
            'logo'                 => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
        ];

        return view('frontend/home', $data);
    }

    public function about()
    {
        // Panggil model yang dibutuhkan
        $pageModel = new \App\Models\PageModel();
        $teamModel = new \App\Models\TeamModel();

        $data = [
            'title'    => 'Tentang Kami - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            // Mengambil data halaman berdasarkan slug yang dibuat di CMS
            'profile'  => $pageModel->where('slug', 'profile-perusahaan')->first(),
            'visimisi' => $pageModel->where('slug', 'visi-misi')->first(),
            // Mengambil data tim yang statusnya published
            'teams'    => $teamModel->where('status', 'published')->orderBy('sort_order', 'ASC')->findAll(),
            'logo'                 => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
        ];

        return view('frontend/about', $data);
    }

    public function services()
    {
        $serviceModel = new \App\Models\ServiceModel();
        $data = [
            'title'    => 'Layanan Kami - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'services' => $serviceModel->where('status', 'published')->findAll(),
            'logo'                 => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
        ];
        return view('frontend/services', $data);
    }

    public function service_detail($slug)
    {
        $serviceModel = new \App\Models\ServiceModel();
        $service = $serviceModel->where('slug', $slug)->first();

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'        => $service['title'] . ' - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'service'      => $service,
            'all_services' => $serviceModel->where('status', 'published')->findAll(),
            'logo'                 => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI', // Untuk list di sidebar
        ];
        return view('frontend/service_detail', $data);
    }

    public function portfolio()
    {
        $portfolioModel = new \App\Models\PortfolioModel();
        $categoryModel  = new \App\Models\CategoryModel();

        $data = [
            'title'      => 'Portofolio - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'categories' => $categoryModel->where('type', 'portfolio')->findAll(),
            'portfolios' => $portfolioModel->where('portfolios.status', 'published')->getAllPortfolios(),
            'logo'                 => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
        ];
        return view('frontend/portfolio', $data);
    }

    public function portfolio_detail($slug)
    {
        $portfolioModel = new \App\Models\PortfolioModel();

        $portfolio = $portfolioModel->where('slug', $slug)->first();

        if (!$portfolio) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // --- PERBAIKAN QUERY GALERI ---
        // Jika Anda punya model khusus galeri (misal: PortfolioGalleryModel)
        $db = \Config\Database::connect();

        // Sesuaikan nama tabel 'portfolio_galleries' atau 'media_galleries' sesuai CMS Anda.
        // Asumsi: tabel menyimpan ID portofolio dan nama filenya
        $galleries = $db->table('media_gallery') // Ganti dengan nama tabel galeri yang benar
            ->where('relation_id', $portfolio['id']) // Atau 'portfolio_id'
            ->get()->getResultArray();

        $data = [
            'title'     => $portfolio['title'] . ' - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'portfolio' => $portfolio,
            'galleries' => $galleries, // Data galeri dikirim ke View
            'category'  => (new \App\Models\CategoryModel())->find($portfolio['category_id']),
            'logo'      => (string)get_setting('logo_kantor'),
        ];
        return view('frontend/portfolio_detail', $data);
    }

    public function portfolio_detail1($slug)
    {
        $portfolioModel = new \App\Models\PortfolioModel();
        $mediaModel     = new \App\Models\MediaGalleryModel();

        $portfolio = $portfolioModel->where('slug', $slug)->first();

        if (!$portfolio) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'     => $portfolio['title'] . ' - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'portfolio' => $portfolio,
            // Ambil semua foto galeri tambahan untuk slider
            'galleries' => $mediaModel->where(['relation_id' => $portfolio['id'], 'relation_type' => 'portfolio'])->findAll(),
            // Ambil nama kategori
            'category'  => (new \App\Models\CategoryModel())->find($portfolio['category_id']),
            'logo'                 => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
        ];
        return view('frontend/portfolio_detail', $data);
    }

    public function blog()
    {
        $postModel = new \App\Models\PostModel();
        $search = $this->request->getVar('search');

        if ($search) {
            $postModel->like('title', $search)->orLike('content', $search);
        }

        $data = [
            'title'        => 'Blog - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'posts'        => $postModel->where('status', 'published')->orderBy('created_at', 'DESC')->paginate(5, 'blog'),
            'pager'        => $postModel->pager,
            'recent_posts' => $postModel->where('status', 'published')->orderBy('created_at', 'DESC')->limit(5)->findAll(),
            'logo'         => (string)get_setting('logo_kantor'),
        ];
        return view('frontend/blog', $data);
    }

    public function blog_detail($slug)
    {
        $postModel = new \App\Models\PostModel();
        $post = $postModel->where('slug', $slug)->first();

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'        => $post['title'] . ' - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'post'         => $post,
            'recent_posts' => $postModel->where('status', 'published')->orderBy('created_at', 'DESC')->limit(5)->findAll(),
            'logo'         => (string)get_setting('logo_kantor'),
        ];
        return view('frontend/blog_detail', $data);
    }

    /**
     * Render any published page created from the CMS page manager.
     */
    public function page($slug)
    {
        $pageModel = new \App\Models\PageModel();
        $page = $pageModel
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('frontend/page', [
            'title'            => ($page['meta_title'] ?: $page['title']) . ' - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'page'             => $page,
            'meta_description' => $page['meta_description'] ?: get_setting('meta_description'),
            'logo'             => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
        ]);
    }

    public function contact()
    {
        $data = [
            'title' => 'Hubungi Kami - ' . (get_setting('nama_perusahaan') ?? 'TRE'),
            'logo'                 => get_setting('logo_kantor') ?? 'PT. TRISENTOSA RAYA ESOLUSI',
        ];
        return view('frontend/contact', $data);
    }

    public function send_message()
    {
        if (!$this->validate([
            'name'    => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'subject' => 'required|min_length[5]',
            'message' => 'required|min_length[10]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Mohon isi form dengan benar.');
        }

        $messageModel = new \App\Models\MessageModel();

        $dataInsert = [
            'name'        => $this->request->getPost('name'),
            'email'       => $this->request->getPost('email'),
            'subject'     => $this->request->getPost('subject'),
            'message'     => $this->request->getPost('message'),
            'is_read'     => 0,
            'sender_type' => 'visitor',
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $messageModel->insert($dataInsert);

        $emailService = \Config\Services::email();

        // $emailTujuan = get_setting('email_perusahaan') ?? 'admin@trisentosaraya.co.id';
        $emailTujuan = 'imam@trisentosaraya.co.id';

        $emailService->setTo($emailTujuan);
        $emailService->setFrom($this->request->getPost('email'), $this->request->getPost('name'));
        $emailService->setSubject("Pesan Baru Website: " . $this->request->getPost('subject'));

        $pesanHtml = "
        <h3>Pesan Baru dari Website TRE</h3>
        <hr>
        <p><strong>Nama:</strong> {$dataInsert['name']}</p>
        <p><strong>Email:</strong> {$dataInsert['email']}</p>
        <p><strong>Subjek:</strong> {$dataInsert['subject']}</p>
        <p><strong>Isi Pesan:</strong><br>{$dataInsert['message']}</p>
        <hr>
        <p>Pesan ini dikirim secara otomatis oleh sistem CMS TRE.</p>
    ";

        $emailService->setMessage($pesanHtml);

        if ($emailService->send()) {
            return redirect()->to('/contact')->with('success', 'Pesan Anda telah terkirim ke tim kami.');
        } else {
            return redirect()->to('/contact')->with('success', 'Pesan Anda tersimpan di sistem kami, namun notifikasi email gagal terkirim.');
        }
    }
}
