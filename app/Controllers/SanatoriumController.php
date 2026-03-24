<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Sanatorium;
use App\Services\SeoService;

class SanatoriumController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page   = max(1, (int)($request->get('page') ?? 1));
        $data   = Sanatorium::active($page, 12);
        $seo    = new SeoService();
        $seo->resolve('sanatoriums', null, null, [], $locale);
        return $this->render('sanatoriums/index', ['seo' => $seo, 'items' => $data['items'], 'pagination' => $data, 'locale' => $locale]);
    }

    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? '';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $item   = Sanatorium::findBySlug($slug);
        if (!$item) return $this->notFound();
        $seo = new SeoService();
        $seo->resolve('sanatoriums:show', 'sanatorium', $item['id'], array_merge($item, [
            'name' => Sanatorium::getName($item, $locale),
        ]), $locale);
        return $this->render('sanatoriums/show', ['seo' => $seo, 'item' => $item, 'locale' => $locale]);
    }
}
