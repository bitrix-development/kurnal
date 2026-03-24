<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Event;
use App\Services\SeoService;

class EventController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page   = max(1, (int)($request->get('page') ?? 1));
        $data   = Event::published($page, 12);
        $seo    = new SeoService();
        $seo->resolve('events', null, null, [], $locale);
        return $this->render('events/index', ['seo' => $seo, 'items' => $data['items'], 'pagination' => $data, 'locale' => $locale]);
    }

    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? '';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $item   = Event::findBySlug($slug);
        if (!$item) return $this->notFound();
        $seo = new SeoService();
        $seo->resolve('events:show', 'event', $item['id'], array_merge($item, [
            'title' => Event::getTitle($item, $locale),
        ]), $locale);
        return $this->render('events/show', ['seo' => $seo, 'item' => $item, 'locale' => $locale]);
    }
}
