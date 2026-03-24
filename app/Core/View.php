<?php
declare(strict_types=1);

namespace App\Core;

class View
{
    private string $viewPath;
    private array $shared = [];

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views';
    }

    public function share(string $key, mixed $value): void
    {
        $this->shared[$key] = $value;
    }

    public function render(string $template, array $data = []): string
    {
        $data = array_merge($this->shared, $data);
        $file = $this->viewPath . '/' . str_replace('.', '/', $template) . '.php';

        if (!file_exists($file)) {
            throw new \RuntimeException("View not found: {$file}");
        }

        return $this->renderFile($file, $data);
    }

    public function renderLayout(string $layout, string $template, array $data = []): string
    {
        $data = array_merge($this->shared, $data);
        $layoutFile = $this->viewPath . '/layouts/' . $layout . '.php';

        $data['content'] = $this->render($template, $data);

        if (!file_exists($layoutFile)) {
            throw new \RuntimeException("Layout not found: {$layoutFile}");
        }

        return $this->renderFile($layoutFile, $data);
    }

    public function partial(string $name, array $data = []): string
    {
        return $this->render('partials/' . $name, $data);
    }

    private function renderFile(string $file, array $data): string
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require $file;
        return ob_get_clean() ?: '';
    }

    public function e(mixed $value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
