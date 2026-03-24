<?php
declare(strict_types=1);

namespace App\Core;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

class Router
{
    private array $routes = [];
    private Container $container;
    private array $middlewares = [];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function add(string $method, string $pattern, array|callable $handler): void
    {
        $this->routes[] = [$method, $pattern, $handler];
    }

    public function get(string $pattern, array|callable $handler): void
    {
        $this->add('GET', $pattern, $handler);
    }

    public function post(string $pattern, array|callable $handler): void
    {
        $this->add('POST', $pattern, $handler);
    }

    public function group(string $prefix, callable $callback): void
    {
        $groupRouter = new self($this->container);
        $callback($groupRouter);
        foreach ($groupRouter->routes as [$method, $pattern, $handler]) {
            $this->add($method, $prefix . $pattern, $handler);
        }
    }

    public function dispatch(Request $request): Response
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) {
            foreach ($this->routes as [$method, $pattern, $handler]) {
                $r->addRoute($method, $pattern, $handler);
            }
        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()
        );

        return match ($routeInfo[0]) {
            Dispatcher::NOT_FOUND     => $this->handleNotFound(),
            Dispatcher::METHOD_NOT_ALLOWED => $this->handleMethodNotAllowed(),
            Dispatcher::FOUND         => $this->handleFound($routeInfo[1], $routeInfo[2], $request),
        };
    }

    private function handleFound(array|callable $handler, array $vars, Request $request): Response
    {
        // Detect locale from URL
        $locale = null;
        if (isset($vars['lang'])) {
            $locale = $vars['lang'];
            unset($vars['lang']);
        }

        $locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
        if ($locale && in_array($locale, $locales)) {
            define('CURRENT_LOCALE', $locale);
        } elseif (!defined('CURRENT_LOCALE')) {
            define('CURRENT_LOCALE', $_ENV['APP_DEFAULT_LOCALE'] ?? 'ru');
        }

        if (is_array($handler)) {
            [$controllerClass, $method] = $handler;
            $controller = new $controllerClass($this->container);
            return $controller->$method($request, $vars);
        }

        return $handler($request, $vars);
    }

    private function handleNotFound(): Response
    {
        $response = new Response();
        $response->setStatus(404);
        $view = new View();
        $response->setBody($view->render('errors/404', ['code' => 404]));
        return $response;
    }

    private function handleMethodNotAllowed(): Response
    {
        $response = new Response();
        $response->setStatus(405);
        $response->setBody('Method Not Allowed');
        return $response;
    }
}
