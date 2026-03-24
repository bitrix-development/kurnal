<?php
declare(strict_types=1);

namespace App\Services;

class I18nService
{
    private array $translations = [];
    private string $locale;
    private array $supported;

    public function __construct()
    {
        $this->supported = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
        $this->locale    = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : ($_ENV['APP_DEFAULT_LOCALE'] ?? 'ru');
        $this->loadTranslations();
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getSupportedLocales(): array
    {
        return $this->supported;
    }

    public function isSupported(string $locale): bool
    {
        return in_array($locale, $this->supported);
    }

    public function trans(string $key, array $replace = []): string
    {
        $keys  = explode('.', $key);
        $value = $this->translations;
        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $key;
            }
            $value = $value[$k];
        }

        $result = is_string($value) ? $value : $key;
        foreach ($replace as $search => $replacement) {
            $result = str_replace(':' . $search, $replacement, $result);
        }
        return $result;
    }

    public function url(string $path = ''): string
    {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        $locale = $this->locale;
        $path   = ltrim($path, '/');
        return "{$base}/{$locale}" . ($path ? "/{$path}" : '');
    }

    public function switchUrl(string $locale): string
    {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        $path = $this->getCurrentPath();
        return "{$base}/{$locale}{$path}";
    }

    private function getCurrentPath(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $uri = parse_url($uri, PHP_URL_PATH) ?? '/';
        // Strip current locale prefix
        foreach ($this->supported as $loc) {
            if (str_starts_with($uri, '/' . $loc)) {
                return substr($uri, strlen('/' . $loc));
            }
        }
        return $uri;
    }

    private function loadTranslations(): void
    {
        $file = ROOT . '/config/lang/' . $this->locale . '.php';
        if (file_exists($file)) {
            $this->translations = require $file;
        }
    }

    public function getField(array $row, string $field): string
    {
        $localizedField = $field . '_' . $this->locale;
        if (isset($row[$localizedField]) && $row[$localizedField] !== '') {
            return $row[$localizedField];
        }
        // Fallback to default locale
        $defaultLocale = $_ENV['APP_DEFAULT_LOCALE'] ?? 'ru';
        $defaultField  = $field . '_' . $defaultLocale;
        return $row[$defaultField] ?? $row[$field] ?? '';
    }
}
