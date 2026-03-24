<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class SitemapController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $appUrl  = rtrim($_ENV['APP_URL'] ?? '', '/');
        $locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');

        $urls = [];
        foreach ($locales as $locale) {
            $urls[] = ['loc' => $appUrl . '/' . $locale, 'changefreq' => 'daily', 'priority' => '1.0'];
            foreach (['news', 'blog', 'rooms', 'services', 'events', 'auctions', 'sanatoriums', 'gallery', 'reviews'] as $section) {
                $urls[] = ['loc' => $appUrl . '/' . $locale . '/' . $section, 'changefreq' => 'weekly', 'priority' => '0.8'];
            }
        }

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
