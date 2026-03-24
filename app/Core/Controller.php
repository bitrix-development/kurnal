<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected Container $container;
    protected View $view;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->view      = new View();
    }

    protected function render(string $template, array $data = []): Response
    {
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : ($_ENV['APP_DEFAULT_LOCALE'] ?? 'ru');
        $data['locale'] = $locale;
        $data['app_url'] = rtrim($_ENV['APP_URL'] ?? '', '/');
        $data['locales'] = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');

        $html = $this->view->renderLayout('main', $template, $data);
        $response = new Response();
        $response->setBody($html);
        return $response;
    }

    protected function renderAdmin(string $template, array $data = []): Response
    {
        $data['app_url'] = rtrim($_ENV['APP_URL'] ?? '', '/');
        $html = $this->view->renderLayout('admin', $template, $data);
        $response = new Response();
        $response->setBody($html);
        return $response;
    }

    protected function redirect(string $url, int $code = 302): Response
    {
        $response = new Response();
        $response->setStatus($code);
        $response->setHeader('Location', $url);
        $response->setBody('');
        return $response;
    }

    protected function json(mixed $data, int $code = 200): Response
    {
        $response = new Response();
        $response->setStatus($code);
        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
        $response->setBody(json_encode($data, JSON_UNESCAPED_UNICODE) ?: '{}');
        return $response;
    }

    protected function notFound(): Response
    {
        $response = new Response();
        $response->setStatus(404);
        $html = $this->view->renderLayout('main', 'errors/404', ['code' => 404]);
        $response->setBody($html);
        return $response;
    }

    protected function isAdmin(): bool
    {
        return !empty($_SESSION['admin_id']);
    }

    protected function requireAdmin(): void
    {
        if (!$this->isAdmin()) {
            Response::redirect('/admin/login');
        }
    }
}
