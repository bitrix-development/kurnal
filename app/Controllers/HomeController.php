<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\News;
use App\Models\Blog;
use App\Models\Setting;
use App\Services\SeoService;

class HomeController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $seo    = new SeoService();
        $seo->resolve('home', null, null, [], $locale);

        $latestNews = News::where('status = ?', ['published'], 'published_at DESC, id DESC', 6);
        $latestBlog = Blog::where('status = ?', ['published'], 'published_at DESC, id DESC', 3);
        $settings   = Setting::all();

        return $this->render('pages/home', [
            'seo'        => $seo,
            'latestNews' => $latestNews,
            'latestBlog' => $latestBlog,
            'settings'   => $settings,
        ]);
    }
}
