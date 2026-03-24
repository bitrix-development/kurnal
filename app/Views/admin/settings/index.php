<?php
/**
 * Admin settings page
 * @var array $settings
 */
?>
<div class="mb-4">
    <h2 class="mb-0">Настройки сайта</h2>
    <p class="text-muted">Общие настройки и контактные данные</p>
</div>

<form method="post" action="/admin/settings/save">
<?= \App\Services\CsrfService::field() ?>
<div class="row gy-4">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">Основные</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Название сайта</label>
                    <input type="text" name="site_name" class="form-control" value="<?= e($settings['site_name'] ?? 'Курорт Нальчик') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="site_email" class="form-control" value="<?= e($settings['site_email'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Телефон</label>
                    <input type="text" name="site_phone" class="form-control" value="<?= e($settings['site_phone'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Адрес</label>
                    <input type="text" name="site_address" class="form-control" value="<?= e($settings['site_address'] ?? '') ?>">
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">SEO по умолчанию</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Default Description (RU)</label>
                    <textarea name="default_description_ru" class="form-control" rows="3"><?= e($settings['default_description_ru'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Default Description (EN)</label>
                    <textarea name="default_description_en" class="form-control" rows="3"><?= e($settings['default_description_en'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">OG Image URL (по умолчанию)</label>
                    <input type="text" name="og_image" class="form-control" value="<?= e($settings['og_image'] ?? '') ?>"
                           placeholder="/uploads/og-default.jpg">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Google Analytics ID (необязательно)</label>
                    <input type="text" name="google_analytics" class="form-control" value="<?= e($settings['google_analytics'] ?? '') ?>"
                           placeholder="G-XXXXXXXXXX">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">robots.txt</div>
            <div class="card-body">
                <div class="mb-3">
                    <textarea name="robots_txt" class="form-control" rows="10" style="font-family:monospace;"><?= e($settings['robots_txt'] ?? "User-agent: *\nAllow: /\n\nSitemap: " . rtrim($_ENV['APP_URL'] ?? '', '/') . "/sitemap.xml") ?></textarea>
                </div>
                <div class="form-text">Содержимое будет сохранено в файл public/robots.txt при сохранении настроек</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-dark w-100">
                    <i class="bi bi-check me-2"></i>Сохранить настройки
                </button>
            </div>
        </div>
    </div>
</div>
</form>
