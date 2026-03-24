<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Services\SeoService;

class ContactController extends Controller
{
    public function index(Request $request, array $vars = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';
        $seo    = new SeoService();
        $seo->resolve('contact', null, null, [], $locale);
        return $this->render('pages/contact', ['seo' => $seo, 'locale' => $locale]);
    }

    public function send(Request $request, array $vars = []): Response
    {
        return $this->json(['success' => true, 'message' => 'Ваше сообщение отправлено!']);
    }
}
