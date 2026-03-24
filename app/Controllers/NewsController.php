<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\News;
use App\Services\SeoService;

class NewsController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page   = max(1, (int)($request->get('page') ?? 1));
        $data   = News::published($page, 12, $locale);

        $seo = new SeoService();
        $seo->resolve('news', null, null, [], $locale);

        return $this->render('news/index', [
            'seo'      => $seo,
            'items'    => $data['items'],
            'pagination' => $data,
            'locale'   => $locale,
        ]);
    }

    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? '';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $item   = News::findBySlug($slug, $locale);

        if (!$item) {
            return $this->notFound();
        }

        $seo = new SeoService();
        $seo->resolve(
            'news:show',
            'news',
            $item['id'],
            array_merge($item, [
                'title'   => News::getTitle($item, $locale),
                'excerpt' => News::getExcerpt($item, $locale),
            ]),
            $locale
        );

        return $this->render('news/show', [
            'seo'    => $seo,
            'item'   => $item,
            'locale' => $locale,
        ]);
    }
}
