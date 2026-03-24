<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\Database;

class SeoService
{
    private array $meta = [];

    public function set(string $key, mixed $value): void
    {
        $this->meta[$key] = $value;
    }

    public function get(string $key, mixed $default = ''): mixed
    {
        return $this->meta[$key] ?? $default;
    }

    /**
     * Load SEO data with priority:
     * 1. Entity-specific override (entity_type + entity_id)
     * 2. SEO template for entity_type
     * 3. Static page route override
     * 4. Site defaults from settings
     */
    public function resolve(
        string $route,
        ?string $entityType = null,
        ?int $entityId = null,
        array $entityData = [],
        string $locale = 'ru'
    ): void {
        $settings = $this->getSiteSettings();

        // Defaults
        $title       = $settings['site_name'] ?? 'Курорт Нальчик';
        $description = $settings['default_description_' . $locale] ?? $settings['default_description'] ?? '';
        $robots      = 'index, follow';
        $ogType      = 'website';
        $ogImage     = $settings['og_image'] ?? '';

        // 3. Route override
        $routeSeo = Database::fetchOne(
            'SELECT * FROM seo_routes WHERE route = ? AND locale = ?',
            [$route, $locale]
        );
        if ($routeSeo) {
            $title       = $routeSeo['title'] ?: $title;
            $description = $routeSeo['description'] ?: $description;
            $robots      = $routeSeo['robots'] ?: $robots;
            $ogImage     = $routeSeo['og_image'] ?: $ogImage;
        }

        // 2. Entity type template
        if ($entityType) {
            $template = Database::fetchOne(
                'SELECT * FROM seo_templates WHERE entity_type = ? AND locale = ?',
                [$entityType, $locale]
            );
            if ($template && !empty($entityData)) {
                if ($template['title_template']) {
                    $title = $this->applyTemplate($template['title_template'], $entityData, $settings);
                }
                if ($template['description_template']) {
                    $description = $this->applyTemplate($template['description_template'], $entityData, $settings);
                }
                if ($template['robots']) {
                    $robots = $template['robots'];
                }
                $ogType = $template['og_type'] ?? 'article';
            }
        }

        // 1. Entity-specific override
        if ($entityType && $entityId) {
            $override = Database::fetchOne(
                'SELECT * FROM seo_overrides WHERE entity_type = ? AND entity_id = ? AND locale = ?',
                [$entityType, $entityId, $locale]
            );
            if ($override) {
                if ($override['title'])       $title       = $override['title'];
                if ($override['description']) $description = $override['description'];
                if ($override['robots'])      $robots      = $override['robots'];
                if ($override['og_image'])    $ogImage     = $override['og_image'];
            }
        }

        $appUrl    = rtrim($_ENV['APP_URL'] ?? '', '/');
        $canonical = $appUrl . ($_SERVER['REQUEST_URI'] ?? '/');
        // Clean query string from canonical
        $canonical = explode('?', $canonical)[0];

        $this->meta = [
            'title'       => $title,
            'description' => $description,
            'robots'      => $robots,
            'canonical'   => $canonical,
            'og_title'    => $entityData['og_title'] ?? $title,
            'og_description' => $entityData['og_description'] ?? $description,
            'og_url'      => $canonical,
            'og_image'    => !empty($entityData['image']) ? $appUrl . '/uploads/' . $entityData['image'] : ($ogImage ? $appUrl . $ogImage : ''),
            'og_type'     => $ogType,
            'og_locale'   => $locale === 'en' ? 'en_US' : 'ru_RU',
            'site_name'   => $settings['site_name'] ?? 'Курорт Нальчик',
        ];
    }

    public function applyTemplate(string $template, array $data, array $settings = []): string
    {
        $placeholders = array_merge($settings, $data, [
            'site_name' => $settings['site_name'] ?? 'Курорт Нальчик',
        ]);
        foreach ($placeholders as $key => $value) {
            if (is_scalar($value)) {
                $template = str_replace('{{' . $key . '}}', (string)$value, $template);
            }
        }
        return $template;
    }

    private function getSiteSettings(): array
    {
        try {
            $rows = Database::fetchAll('SELECT `key`, `value` FROM settings');
            $settings = [];
            foreach ($rows as $row) {
                $settings[$row['key']] = $row['value'];
            }
            return $settings;
        } catch (\Exception) {
            return [];
        }
    }

    public function renderMeta(): string
    {
        $html = '';

        $title = htmlspecialchars($this->get('title', 'Курорт Нальчик'), ENT_QUOTES, 'UTF-8');
        $desc  = htmlspecialchars($this->get('description', ''), ENT_QUOTES, 'UTF-8');

        $html .= "<title>{$title}</title>\n";

        if ($desc) {
            $html .= "    <meta name=\"description\" content=\"{$desc}\">\n";
        }

        $robots = htmlspecialchars($this->get('robots', 'index, follow'), ENT_QUOTES, 'UTF-8');
        $html .= "    <meta name=\"robots\" content=\"{$robots}\">\n";

        $canonical = htmlspecialchars($this->get('canonical', ''), ENT_QUOTES, 'UTF-8');
        if ($canonical) {
            $html .= "    <link rel=\"canonical\" href=\"{$canonical}\">\n";
        }

        // OpenGraph
        $ogTitle  = htmlspecialchars($this->get('og_title', $this->get('title')), ENT_QUOTES, 'UTF-8');
        $ogDesc   = htmlspecialchars($this->get('og_description', $desc), ENT_QUOTES, 'UTF-8');
        $ogUrl    = htmlspecialchars($this->get('og_url', $canonical), ENT_QUOTES, 'UTF-8');
        $ogImage  = htmlspecialchars($this->get('og_image', ''), ENT_QUOTES, 'UTF-8');
        $ogType   = htmlspecialchars($this->get('og_type', 'website'), ENT_QUOTES, 'UTF-8');
        $ogLocale = htmlspecialchars($this->get('og_locale', 'ru_RU'), ENT_QUOTES, 'UTF-8');
        $siteName = htmlspecialchars($this->get('site_name', 'Курорт Нальчик'), ENT_QUOTES, 'UTF-8');

        $html .= "    <meta property=\"og:type\" content=\"{$ogType}\">\n";
        $html .= "    <meta property=\"og:title\" content=\"{$ogTitle}\">\n";
        if ($ogDesc) {
            $html .= "    <meta property=\"og:description\" content=\"{$ogDesc}\">\n";
        }
        $html .= "    <meta property=\"og:url\" content=\"{$ogUrl}\">\n";
        $html .= "    <meta property=\"og:locale\" content=\"{$ogLocale}\">\n";
        $html .= "    <meta property=\"og:site_name\" content=\"{$siteName}\">\n";
        if ($ogImage) {
            $html .= "    <meta property=\"og:image\" content=\"{$ogImage}\">\n";
        }

        return $html;
    }
}
