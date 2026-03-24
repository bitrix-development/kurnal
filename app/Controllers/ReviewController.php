<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Review;
use App\Services\SeoService;

class ReviewController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $items  = Review::approved();
        $seo    = new SeoService();
        $seo->resolve('reviews', null, null, [], $locale);
        return $this->render('reviews/index', ['seo' => $seo, 'items' => $items, 'locale' => $locale]);
    }
}
