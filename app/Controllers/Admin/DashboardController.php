<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Services\AuthService;
use App\Core\Database;

class DashboardController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();

        $stats = [];
        $tables = [
            'news'       => 'Новости',
            'blog_posts' => 'Блог',
            'rooms'      => 'Номера',
            'services'   => 'Услуги',
            'events'     => 'События',
            'auctions'   => 'Закупки',
            'sanatoriums'=> 'Санатории',
            'gallery'    => 'Галерея',
            'reviews'    => 'Отзывы',
        ];

        foreach ($tables as $table => $label) {
            try {
                $stats[$label] = Database::fetchValue("SELECT COUNT(*) FROM {$table}");
            } catch (\Exception) {
                $stats[$label] = '–';
            }
        }

        return $this->renderAdmin('admin/dashboard', [
            'stats' => $stats,
            'admin' => AuthService::user(),
        ]);
    }
}
