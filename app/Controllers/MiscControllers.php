<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Gallery;
use App\Models\Review;
use App\Services\SeoService;

class GalleryController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $items  = Gallery::active();
        $seo    = new SeoService();
        $seo->resolve('gallery', null, null, [], $locale);
        return $this->render('gallery/index', ['seo' => $seo, 'items' => $items, 'locale' => $locale]);
    }
}

class ReviewController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $items  = Review::approved();
        $seo    = new SeoService();
        $seo->resolve('reviews', null, null, [], $locale);
        return $this->render('reviews/index', ['seo' => $seo, 'items' => $items, 'locale' => $locale]);
    }
}

class ContactController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $seo    = new SeoService();
        $seo->resolve('contact', null, null, [], $locale);
        return $this->render('pages/contact', ['seo' => $seo, 'locale' => $locale]);
    }

    public function send(Request $request, array $vars = []): Response
    {
        // Simple form submission - in production would send email
        return $this->json(['success' => true, 'message' => 'Ваше сообщение отправлено!']);
    }
}

class DirectorController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $seo    = new SeoService();
        $seo->resolve('director', null, null, [], $locale);
        return $this->render('pages/director', ['seo' => $seo, 'locale' => $locale]);
    }
    public function send(Request $request, array $vars = []): Response
    {
        return $this->json(['success' => true, 'message' => 'Ваше сообщение отправлено!']);
    }
}

class SitemapController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $appUrl  = rtrim($_ENV['APP_URL'] ?? '', '/');
        $locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');

        $urls = [];
        foreach ($locales as $locale) {
            $urls[] = ['loc' => $appUrl . '/' . $locale, 'changefreq' => 'daily', 'priority' => '1.0'];
            foreach (['news', 'blog', 'rooms', 'services', 'events', 'auctions', 'sanatoriums'] as $section) {
                $urls[] = ['loc' => $appUrl . '/' . $locale . '/' . $section, 'changefreq' => 'weekly', 'priority' => '0.8'];
            }
        }

        // Dynamic items
        $dynamicSections = [
            ['table' => 'news', 'section' => 'news', 'cond' => "status = 'published'"],
            ['table' => 'blog_posts', 'section' => 'blog', 'cond' => "status = 'published'"],
            ['table' => 'rooms', 'section' => 'rooms', 'cond' => "status = 'active'"],
            ['table' => 'services', 'section' => 'services', 'cond' => "status = 'active'"],
            ['table' => 'events', 'section' => 'events', 'cond' => "status = 'published'"],
            ['table' => 'auctions', 'section' => 'auctions', 'cond' => "status = 'published'"],
            ['table' => 'sanatoriums', 'section' => 'sanatoriums', 'cond' => "status = 'active'"],
        ];

        try {
            foreach ($dynamicSections as $ds) {
                $items = \App\Core\Database::fetchAll("SELECT slug, updated_at FROM {$ds['table']} WHERE {$ds['cond']}");
                foreach ($items as $item) {
                    foreach ($locales as $locale) {
                        $urls[] = [
                            'loc'        => $appUrl . '/' . $locale . '/' . $ds['section'] . '/' . $item['slug'],
                            'lastmod'    => substr($item['updated_at'] ?? '', 0, 10),
                            'changefreq' => 'monthly',
                            'priority'   => '0.6',
                        ];
                    }
                }
            }
        } catch (\Exception) {}

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            if (!empty($url['lastmod']))    $xml .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
            if (!empty($url['changefreq'])) $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            if (!empty($url['priority']))   $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        $response = new Response();
        $response->setHeader('Content-Type', 'application/xml; charset=UTF-8');
        $response->setBody($xml);
        return $response;
    }
}
