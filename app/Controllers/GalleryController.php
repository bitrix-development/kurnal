<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Gallery;
use App\Services\SeoService;

class GalleryController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $items  = Gallery::active();
        $seo    = new SeoService();
        $seo->resolve('gallery', null, null, [], $locale);
        return $this->render('gallery/index', ['seo' => $seo, 'items' => $items, 'locale' => $locale]);
    }
}
