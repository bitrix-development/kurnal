<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Room;
use App\Services\SeoService;

class RoomController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale     = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page       = max(1, (int)($request->get('page') ?? 1));
        $categoryId = $request->get('category') ? (int)$request->get('category') : null;
        $data       = Room::active($page, 12, $categoryId);
        $categories = Room::getAllCategories();
        $seo        = new SeoService();
        $seo->resolve('rooms', null, null, [], $locale);
        return $this->render('rooms/index', [
            'seo' => $seo, 'items' => $data['items'], 'pagination' => $data,
            'categories' => $categories, 'locale' => $locale, 'currentCategory' => $categoryId,
        ]);
    }

    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? '';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $item   = Room::findBySlug($slug);
        if (!$item) return $this->notFound();
        $category = $item['category_id'] ? Room::getCategory((int)$item['category_id']) : null;
        $seo = new SeoService();
        $seo->resolve('rooms:show', 'room', $item['id'], array_merge($item, [
            'name'       => Room::getName($item, $locale),
            'price_from' => $item['price_from'] ?? '',
        ]), $locale);
        return $this->render('rooms/show', ['seo' => $seo, 'item' => $item, 'category' => $category, 'locale' => $locale]);
    }
}
