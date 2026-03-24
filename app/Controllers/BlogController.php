<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Blog;
use App\Services\SeoService;

class BlogController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page   = max(1, (int)($request->get('page') ?? 1));
        $data   = Blog::published($page, 12);
        $seo    = new SeoService();
        $seo->resolve('blog', null, null, [], $locale);
        return $this->render('blog/index', [
            'seo' => $seo, 'items' => $data['items'], 'pagination' => $data, 'locale' => $locale,
        ]);
    }

    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? '';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $item   = Blog::findBySlug($slug);
        if (!$item) return $this->notFound();
        $seo = new SeoService();
        $seo->resolve('blog:show', 'blog', $item['id'], array_merge($item, [
            'title' => Blog::getTitle($item, $locale),
            'excerpt' => Blog::getExcerpt($item, $locale),
        ]), $locale);
        return $this->render('blog/show', ['seo' => $seo, 'item' => $item, 'locale' => $locale]);
    }
}
