<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Auction;
use App\Services\SeoService;

class AuctionController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $page   = max(1, (int)($request->get('page') ?? 1));
        $data   = Auction::published($page, 12);
        $seo    = new SeoService();
        $seo->resolve('auctions', null, null, [], $locale);
        return $this->render('auctions/index', ['seo' => $seo, 'items' => $data['items'], 'pagination' => $data, 'locale' => $locale]);
    }

    public function show(Request $request, array $vars = []): Response
    {
        $slug   = $vars['slug'] ?? '';
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $item   = Auction::findBySlug($slug);
        if (!$item) return $this->notFound();
        $seo = new SeoService();
        $seo->resolve('auctions:show', 'auction', $item['id'], array_merge($item, [
            'title' => Auction::getTitle($item, $locale),
        ]), $locale);
        return $this->render('auctions/show', ['seo' => $seo, 'item' => $item, 'locale' => $locale]);
    }
}
