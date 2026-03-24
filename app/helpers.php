<?php
declare(strict_types=1);

if (!function_exists('url')) {
    function url(string $path = ''): string
    {
        $base   = rtrim($_ENV['APP_URL'] ?? '', '/');
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : ($_ENV['APP_DEFAULT_LOCALE'] ?? 'ru');
        $path   = ltrim($path, '/');
        return $base . '/' . $locale . ($path ? '/' . $path : '');
    }
}

if (!function_exists('asset')) {
    function asset(string $path = ''): string
    {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        return $base . '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('e')) {
    function e(mixed $value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('t')) {
    function t(string $key, array $replace = []): string
    {
        static $translations = [];
        $locale = defined('CURRENT_LOCALE') ? CURRENT_LOCALE : 'ru';

        if (empty($translations[$locale])) {
            $file = ROOT . '/config/lang/' . $locale . '.php';
            $translations[$locale] = file_exists($file) ? require $file : [];
        }

        $keys  = explode('.', $key);
        $value = $translations[$locale];
        foreach ($keys as $k) {
            if (!isset($value[$k])) return $key;
            $value = $value[$k];
        }

        $result = is_string($value) ? $value : $key;
        foreach ($replace as $search => $replacement) {
            $result = str_replace(':' . $search, $replacement, $result);
        }
        return $result;
    }
}

if (!function_exists('slug_url')) {
    function slug_url(string $section, string $slug): string
    {
        return url($section . '/' . $slug);
    }
}

if (!function_exists('locale_url')) {
    function locale_url(string $locale, ?string $currentPath = null): string
    {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        if ($currentPath === null) {
            $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
            $locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
            foreach ($locales as $loc) {
                if (str_starts_with($uri, '/' . $loc)) {
                    $currentPath = substr($uri, strlen('/' . $loc));
                    break;
                }
            }
            $currentPath ??= '/';
        }
        return $base . '/' . $locale . $currentPath;
    }
}

if (!function_exists('format_date')) {
    function format_date(string $date, string $locale = 'ru'): string
    {
        if (!$date) return '';
        $ts = strtotime($date);
        if (!$ts) return $date;

        if ($locale === 'ru') {
            $months = ['', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
                       'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
            $d = (int)date('j', $ts);
            $m = (int)date('n', $ts);
            $y = date('Y', $ts);
            return "{$d} {$months[$m]}, {$y}";
        }
        return date('F j, Y', $ts);
    }
}

if (!function_exists('truncate')) {
    function truncate(string $text, int $length = 150): string
    {
        $text = strip_tags($text);
        if (mb_strlen($text) <= $length) return $text;
        return mb_substr($text, 0, $length) . '…';
    }
}

if (!function_exists('uploads_url')) {
    function uploads_url(string $path): string
    {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        return $base . '/uploads/' . ltrim($path, '/');
    }
}
