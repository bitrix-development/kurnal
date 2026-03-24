<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\NewsController;
use App\Controllers\BlogController;
use App\Controllers\RoomController;
use App\Controllers\ServiceController;
use App\Controllers\EventController;
use App\Controllers\AuctionController;
use App\Controllers\SanatoriumController;
use App\Controllers\GalleryController;
use App\Controllers\ReviewController;
use App\Controllers\ContactController;
use App\Controllers\DirectorController;
use App\Controllers\SitemapController;

// Admin controllers
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\PagesAdminController;
use App\Controllers\Admin\NewsAdminController;
use App\Controllers\Admin\BlogAdminController;
use App\Controllers\Admin\RoomsAdminController;
use App\Controllers\Admin\ServicesAdminController;
use App\Controllers\Admin\EventsAdminController;
use App\Controllers\Admin\AuctionsAdminController;
use App\Controllers\Admin\SanatoriumsAdminController;
use App\Controllers\Admin\GalleryAdminController;
use App\Controllers\Admin\ReviewsAdminController;
use App\Controllers\Admin\SeoAdminController;
use App\Controllers\Admin\SettingsAdminController;

/** @var \App\Core\Router $router */

// ── Sitemap & robots ──────────────────────────────────────────────────────────
$router->get('/sitemap.xml', [SitemapController::class, 'index']);

// ── Root redirect to default locale ──────────────────────────────────────────
$router->get('/', function (\App\Core\Request $req) {
    $default = $_ENV['APP_DEFAULT_LOCALE'] ?? 'ru';
    return new class($default) extends \App\Core\Response {
        public function __construct(string $locale) {
            parent::__construct();
            $this->setStatus(302);
            $this->setHeader('Location', '/' . $locale);
        }
    };
});

// ── Front-end routes with locale ─────────────────────────────────────────────
$locales = implode('|', explode(',', $_ENV['APP_LOCALES'] ?? 'ru|en'));

$router->get('/{lang:' . $locales . '}',                   [HomeController::class,       'index']);
$router->get('/{lang:' . $locales . '}/news',              [NewsController::class,        'index']);
$router->get('/{lang:' . $locales . '}/news/{slug}',       [NewsController::class,        'show']);
$router->get('/{lang:' . $locales . '}/blog',              [BlogController::class,        'index']);
$router->get('/{lang:' . $locales . '}/blog/{slug}',       [BlogController::class,        'show']);
$router->get('/{lang:' . $locales . '}/rooms',             [RoomController::class,        'index']);
$router->get('/{lang:' . $locales . '}/rooms/{slug}',      [RoomController::class,        'show']);
$router->get('/{lang:' . $locales . '}/services',          [ServiceController::class,     'index']);
$router->get('/{lang:' . $locales . '}/services/{slug}',   [ServiceController::class,     'show']);
$router->get('/{lang:' . $locales . '}/events',            [EventController::class,       'index']);
$router->get('/{lang:' . $locales . '}/events/{slug}',     [EventController::class,       'show']);
$router->get('/{lang:' . $locales . '}/auctions',          [AuctionController::class,     'index']);
$router->get('/{lang:' . $locales . '}/auctions/{slug}',   [AuctionController::class,     'show']);
$router->get('/{lang:' . $locales . '}/sanatoriums',       [SanatoriumController::class,  'index']);
$router->get('/{lang:' . $locales . '}/sanatoriums/{slug}',[SanatoriumController::class,  'show']);
$router->get('/{lang:' . $locales . '}/gallery',           [GalleryController::class,     'index']);
$router->get('/{lang:' . $locales . '}/reviews',           [ReviewController::class,      'index']);
$router->get('/{lang:' . $locales . '}/contact',           [ContactController::class,     'index']);
$router->post('/{lang:' . $locales . '}/contact/send',     [ContactController::class,     'send']);
$router->get('/{lang:' . $locales . '}/director',          [DirectorController::class,    'index']);
$router->post('/{lang:' . $locales . '}/director/send',    [DirectorController::class,    'send']);

// Static pages (about, faq, documents, privacy-policy, agreement, etc.)
$router->get('/{lang:' . $locales . '}/{slug}',            [PageController::class,        'show']);

// ── Admin routes ──────────────────────────────────────────────────────────────
$router->get('/admin',                    [DashboardController::class,    'index']);
$router->get('/admin/login',              [AuthController::class,         'loginForm']);
$router->post('/admin/login',             [AuthController::class,         'login']);
$router->get('/admin/logout',             [AuthController::class,         'logout']);

// Pages CRUD
$router->get('/admin/pages',              [PagesAdminController::class,   'index']);
$router->get('/admin/pages/create',       [PagesAdminController::class,   'create']);
$router->post('/admin/pages/store',       [PagesAdminController::class,   'store']);
$router->get('/admin/pages/{id}/edit',    [PagesAdminController::class,   'edit']);
$router->post('/admin/pages/{id}/update', [PagesAdminController::class,   'update']);
$router->post('/admin/pages/{id}/delete', [PagesAdminController::class,   'delete']);

// News CRUD
$router->get('/admin/news',               [NewsAdminController::class,    'index']);
$router->get('/admin/news/create',        [NewsAdminController::class,    'create']);
$router->post('/admin/news/store',        [NewsAdminController::class,    'store']);
$router->get('/admin/news/{id}/edit',     [NewsAdminController::class,    'edit']);
$router->post('/admin/news/{id}/update',  [NewsAdminController::class,    'update']);
$router->post('/admin/news/{id}/delete',  [NewsAdminController::class,    'delete']);

// Blog CRUD
$router->get('/admin/blog',               [BlogAdminController::class,    'index']);
$router->get('/admin/blog/create',        [BlogAdminController::class,    'create']);
$router->post('/admin/blog/store',        [BlogAdminController::class,    'store']);
$router->get('/admin/blog/{id}/edit',     [BlogAdminController::class,    'edit']);
$router->post('/admin/blog/{id}/update',  [BlogAdminController::class,    'update']);
$router->post('/admin/blog/{id}/delete',  [BlogAdminController::class,    'delete']);

// Rooms CRUD
$router->get('/admin/rooms',              [RoomsAdminController::class,   'index']);
$router->get('/admin/rooms/create',       [RoomsAdminController::class,   'create']);
$router->post('/admin/rooms/store',       [RoomsAdminController::class,   'store']);
$router->get('/admin/rooms/{id}/edit',    [RoomsAdminController::class,   'edit']);
$router->post('/admin/rooms/{id}/update', [RoomsAdminController::class,   'update']);
$router->post('/admin/rooms/{id}/delete', [RoomsAdminController::class,   'delete']);

// Services CRUD
$router->get('/admin/services',               [ServicesAdminController::class,   'index']);
$router->get('/admin/services/create',        [ServicesAdminController::class,   'create']);
$router->post('/admin/services/store',        [ServicesAdminController::class,   'store']);
$router->get('/admin/services/{id}/edit',     [ServicesAdminController::class,   'edit']);
$router->post('/admin/services/{id}/update',  [ServicesAdminController::class,   'update']);
$router->post('/admin/services/{id}/delete',  [ServicesAdminController::class,   'delete']);

// Events CRUD
$router->get('/admin/events',               [EventsAdminController::class,   'index']);
$router->get('/admin/events/create',        [EventsAdminController::class,   'create']);
$router->post('/admin/events/store',        [EventsAdminController::class,   'store']);
$router->get('/admin/events/{id}/edit',     [EventsAdminController::class,   'edit']);
$router->post('/admin/events/{id}/update',  [EventsAdminController::class,   'update']);
$router->post('/admin/events/{id}/delete',  [EventsAdminController::class,   'delete']);

// Auctions CRUD
$router->get('/admin/auctions',               [AuctionsAdminController::class,   'index']);
$router->get('/admin/auctions/create',        [AuctionsAdminController::class,   'create']);
$router->post('/admin/auctions/store',        [AuctionsAdminController::class,   'store']);
$router->get('/admin/auctions/{id}/edit',     [AuctionsAdminController::class,   'edit']);
$router->post('/admin/auctions/{id}/update',  [AuctionsAdminController::class,   'update']);
$router->post('/admin/auctions/{id}/delete',  [AuctionsAdminController::class,   'delete']);

// Sanatoriums CRUD
$router->get('/admin/sanatoriums',               [SanatoriumsAdminController::class,  'index']);
$router->get('/admin/sanatoriums/create',        [SanatoriumsAdminController::class,  'create']);
$router->post('/admin/sanatoriums/store',        [SanatoriumsAdminController::class,  'store']);
$router->get('/admin/sanatoriums/{id}/edit',     [SanatoriumsAdminController::class,  'edit']);
$router->post('/admin/sanatoriums/{id}/update',  [SanatoriumsAdminController::class,  'update']);
$router->post('/admin/sanatoriums/{id}/delete',  [SanatoriumsAdminController::class,  'delete']);

// Gallery CRUD
$router->get('/admin/gallery',               [GalleryAdminController::class,  'index']);
$router->get('/admin/gallery/create',        [GalleryAdminController::class,  'create']);
$router->post('/admin/gallery/store',        [GalleryAdminController::class,  'store']);
$router->get('/admin/gallery/{id}/edit',     [GalleryAdminController::class,  'edit']);
$router->post('/admin/gallery/{id}/update',  [GalleryAdminController::class,  'update']);
$router->post('/admin/gallery/{id}/delete',  [GalleryAdminController::class,  'delete']);

// Reviews CRUD
$router->get('/admin/reviews',               [ReviewsAdminController::class,  'index']);
$router->get('/admin/reviews/create',        [ReviewsAdminController::class,  'create']);
$router->post('/admin/reviews/store',        [ReviewsAdminController::class,  'store']);
$router->get('/admin/reviews/{id}/edit',     [ReviewsAdminController::class,  'edit']);
$router->post('/admin/reviews/{id}/update',  [ReviewsAdminController::class,  'update']);
$router->post('/admin/reviews/{id}/delete',  [ReviewsAdminController::class,  'delete']);

// SEO
$router->get('/admin/seo',                   [SeoAdminController::class,      'index']);
$router->post('/admin/seo/templates',        [SeoAdminController::class,      'saveTemplates']);
$router->post('/admin/seo/routes',           [SeoAdminController::class,      'saveRoutes']);

// Settings
$router->get('/admin/settings',              [SettingsAdminController::class, 'index']);
$router->post('/admin/settings/save',        [SettingsAdminController::class, 'save']);
