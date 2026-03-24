<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Services\AuthService;
use App\Core\Database;

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

        // Update public/robots.txt automatically
        $robotsTxt = $request->post('robots_txt', '');
        if ($robotsTxt) {
            file_put_contents(ROOT . '/public/robots.txt', $robotsTxt);
        }

        return $this->redirect('/admin/settings?saved=1');
    }
}
