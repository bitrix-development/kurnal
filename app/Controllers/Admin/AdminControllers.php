<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Services\AuthService;
use App\Core\Database;

class PagesAdminController extends CrudController
{
    protected string $entity      = 'pages';
    protected string $viewPrefix  = 'admin/pages';
    protected string $routePrefix = '/admin/pages';
    protected array  $translatableFields = ['title', 'body'];
    protected array  $simpleFields = ['slug', 'status'];
    protected string $orderBy     = 'id ASC';
}

class SeoAdminController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $locales   = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
        $templates = Database::fetchAll('SELECT * FROM seo_templates ORDER BY entity_type, locale');
        $routes    = Database::fetchAll('SELECT * FROM seo_routes ORDER BY route, locale');
        return $this->renderAdmin('admin/seo/index', [
            'templates' => $templates,
            'routes'    => $routes,
            'locales'   => $locales,
        ]);
    }

    public function saveTemplates(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $locales    = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
        $entityTypes = ['news', 'blog', 'room', 'service', 'event', 'auction', 'sanatorium', 'page'];

        foreach ($entityTypes as $type) {
            foreach ($locales as $locale) {
                $titleTpl = $request->post("tpl_{$type}_{$locale}_title", '');
                $descTpl  = $request->post("tpl_{$type}_{$locale}_desc", '');
                $robots   = $request->post("tpl_{$type}_{$locale}_robots", 'index, follow');
                $ogType   = $request->post("tpl_{$type}_{$locale}_og_type", 'article');

                $existing = Database::fetchOne(
                    'SELECT id FROM seo_templates WHERE entity_type = ? AND locale = ?',
                    [$type, $locale]
                );
                $data = [
                    'entity_type'          => $type,
                    'locale'               => $locale,
                    'title_template'       => $titleTpl,
                    'description_template' => $descTpl,
                    'robots'               => $robots,
                    'og_type'              => $ogType,
                    'updated_at'           => date('Y-m-d H:i:s'),
                ];
                if ($existing) {
                    Database::update('seo_templates', $data, 'id = ?', [$existing['id']]);
                } else {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    Database::insert('seo_templates', $data);
                }
            }
        }

        return $this->redirect('/admin/seo?saved=1');
    }

    public function saveRoutes(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $locales  = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
        $routes   = ['home', 'news', 'blog', 'rooms', 'services', 'events', 'auctions', 'sanatoriums', 'gallery', 'reviews', 'contact', 'director', 'faq', 'documents'];

        foreach ($routes as $route) {
            foreach ($locales as $locale) {
                $title    = $request->post("route_{$route}_{$locale}_title", '');
                $desc     = $request->post("route_{$route}_{$locale}_desc", '');
                $robots   = $request->post("route_{$route}_{$locale}_robots", 'index, follow');
                $ogImage  = $request->post("route_{$route}_{$locale}_og_image", '');

                $existing = Database::fetchOne(
                    'SELECT id FROM seo_routes WHERE route = ? AND locale = ?',
                    [$route, $locale]
                );
                $data = [
                    'route'       => $route,
                    'locale'      => $locale,
                    'title'       => $title,
                    'description' => $desc,
                    'robots'      => $robots,
                    'og_image'    => $ogImage,
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
                if ($existing) {
                    Database::update('seo_routes', $data, 'id = ?', [$existing['id']]);
                } else {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    Database::insert('seo_routes', $data);
                }
            }
        }

        return $this->redirect('/admin/seo?saved=1');
    }
}

class SettingsAdminController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $settings = Database::fetchAll('SELECT * FROM settings ORDER BY `key`');
        $s = [];
        foreach ($settings as $row) $s[$row['key']] = $row['value'];
        return $this->renderAdmin('admin/settings/index', ['settings' => $s]);
    }

    public function save(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $keys = [
            'site_name', 'site_email', 'site_phone', 'site_address',
            'og_image', 'google_analytics', 'robots_txt',
            'default_description_ru', 'default_description_en',
        ];
        foreach ($keys as $key) {
            $val = $request->post($key, '');
            $existing = Database::fetchOne('SELECT id FROM settings WHERE `key` = ?', [$key]);
            if ($existing) {
                Database::update('settings', ['value' => $val, 'updated_at' => date('Y-m-d H:i:s')], '`key` = ?', [$key]);
            } else {
                Database::insert('settings', ['key' => $key, 'value' => $val, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        return $this->redirect('/admin/settings?saved=1');
    }
}
