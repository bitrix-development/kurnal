<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Page;
use App\Services\SeoService;

class PageController extends Controller
{
    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? 'about';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page   = Page::findBySlug($slug);

        if (!$page) {
            return $this->notFound();
        }

        $seo = new SeoService();
        $seo->resolve('page:' . $slug, 'page', $page['id'], $page, $locale);
        if (!$seo->get('title')) {
            $seo->set('title', Page::getTitle($page, $locale));
        }

        return $this->render('pages/page', [
            'seo'    => $seo,
            'page'   => $page,
            'locale' => $locale,
        ]);
    }
}
