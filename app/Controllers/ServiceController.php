<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Service;
use App\Services\SeoService;

class ServiceController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page   = max(1, (int)($request->get('page') ?? 1));
        $data   = Service::active($page, 24);
        $seo    = new SeoService();
        $seo->resolve('services', null, null, [], $locale);
        return $this->render('services/index', ['seo' => $seo, 'items' => $data['items'], 'pagination' => $data, 'locale' => $locale]);
    }

    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? '';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $item   = Service::findBySlug($slug);
        if (!$item) return $this->notFound();
        $seo = new SeoService();
        $seo->resolve('services:show', 'service', $item['id'], array_merge($item, [
            'name' => Service::getName($item, $locale),
        ]), $locale);
        return $this->render('services/show', ['seo' => $seo, 'item' => $item, 'locale' => $locale]);
    }
}
