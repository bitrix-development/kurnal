<?php
declare(strict_types=1);

namespace App;

use App\Core\Container;
use App\Core\Request;
use App\Core\Router;
use App\Core\Response;
use App\Services\I18nService;
use App\Services\SeoService;

class App
{
    private static ?self $instance = null;
    private Container $container;

    private function __construct()
    {
        $this->container = new Container();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function run(): void
    {
        $request = new Request();
        $this->container->bind('request', fn() => $request);

        // Detect locale from URL
        $i18n = new I18nService();
        $this->container->bind('i18n', fn() => $i18n);

        $seo = new SeoService();
        $this->container->bind('seo', fn() => $seo);

        $router = new Router($this->container);
        $this->container->bind('router', fn() => $router);

        require ROOT . '/config/routes.php';

        $response = $router->dispatch($request);
        $response->send();
    }
}
