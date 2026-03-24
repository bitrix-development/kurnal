<?php
/**
 * Admin SEO settings page
 * @var array $templates
 * @var array $routes
 * @var array $locales
 */

$entityTypes = [
    'news'       => 'Новости (деталка)',
    'blog'       => 'Блог (деталка)',
    'room'       => 'Номера (деталка)',
    'service'    => 'Услуги (деталка)',
    'event'      => 'События (деталка)',
    'auction'    => 'Закупки (деталка)',
    'sanatorium' => 'Санатории (деталка)',
    'page'       => 'Страницы',
];

$routeNames = [
    'home'        => 'Главная',
    'news'        => 'Список новостей',
    'blog'        => 'Список блога',
    'rooms'       => 'Список номеров',
    'services'    => 'Список услуг',
    'events'      => 'Список событий',
    'auctions'    => 'Список закупок',
    'sanatoriums' => 'Список санаториев',
    'gallery'     => 'Галерея',
    'reviews'     => 'Отзывы',
    'contact'     => 'Контакты',
    'director'    => 'Написать директору',
    'faq'         => 'FAQ',
    'documents'   => 'Документы',
];

// Index templates and routes by (type/route, locale)
$tplByTypeLocale   = [];
foreach ($templates as $t) {
    $tplByTypeLocale[$t['entity_type']][$t['locale']] = $t;
}
$routeByNameLocale = [];
foreach ($routes as $r) {
    $routeByNameLocale[$r['route']][$r['locale']] = $r;
}
?>
<div class="mb-4">
    <h2 class="mb-0">SEO настройки</h2>
    <p class="text-muted">Шаблоны мета-тегов и SEO для разделов сайта</p>
</div>

<div class="card mb-5">
    <div class="card-header">
        <i class="bi bi-file-code me-2"></i>Шаблоны (маски) для динамических страниц
        <small class="text-muted ms-2">Используйте плейсхолдеры: {{title}}, {{name}}, {{excerpt}}, {{site_name}}, {{price_from}}</small>
    </div>
    <div class="card-body">
        <form method="post" action="/admin/seo/templates">
        <?php foreach ($entityTypes as $type => $typeLabel): ?>
        <div class="mb-5">
            <h5><?= e($typeLabel) ?></h5>
            <ul class="nav nav-tabs mb-3" id="tpl-tabs-<?= e($type) ?>">
                <?php foreach ($locales as $i => $locale): ?>
                <li class="nav-item">
                    <button class="nav-link <?= $i === 0 ? 'active' : '' ?>"
                            data-bs-toggle="tab" data-bs-target="#tpl-<?= e($type) ?>-<?= e($locale) ?>" type="button">
                        <?= strtoupper(e($locale)) ?>
                    </button>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php foreach ($locales as $i => $locale): ?>
                <?php $d = $tplByTypeLocale[$type][$locale] ?? []; ?>
                <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="tpl-<?= e($type) ?>-<?= e($locale) ?>">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold">Title Template (<?= strtoupper(e($locale)) ?>)</label>
                            <input type="text" name="tpl_<?= e($type) ?>_<?= e($locale) ?>_title" class="form-control"
                                   value="<?= e($d['title_template'] ?? '') ?>"
                                   placeholder="{{title}} — {{site_name}}">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold">Robots</label>
                            <select name="tpl_<?= e($type) ?>_<?= e($locale) ?>_robots" class="form-select">
                                <option value="index, follow" <?= ($d['robots'] ?? '') === 'index, follow' ? 'selected' : '' ?>>index, follow</option>
                                <option value="noindex, follow" <?= ($d['robots'] ?? '') === 'noindex, follow' ? 'selected' : '' ?>>noindex, follow</option>
                                <option value="noindex, nofollow" <?= ($d['robots'] ?? '') === 'noindex, nofollow' ? 'selected' : '' ?>>noindex, nofollow</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description Template (<?= strtoupper(e($locale)) ?>)</label>
                            <textarea name="tpl_<?= e($type) ?>_<?= e($locale) ?>_desc" class="form-control" rows="3"
                                      placeholder="{{excerpt}}. Читайте подробнее на сайте {{site_name}}"><?= e($d['description_template'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-dark"><i class="bi bi-check me-2"></i>Сохранить шаблоны</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-link-45deg me-2"></i>SEO для разделов (списковые страницы)
    </div>
    <div class="card-body">
        <form method="post" action="/admin/seo/routes">
        <?php foreach ($routeNames as $route => $routeLabel): ?>
        <div class="mb-4">
            <h5><?= e($routeLabel) ?></h5>
            <div class="row gy-3">
                <?php foreach ($locales as $locale): ?>
                <?php $d = $routeByNameLocale[$route][$locale] ?? []; ?>
                <div class="col-lg-6">
                    <div class="border rounded p-3">
                        <h6 class="mb-3"><?= strtoupper(e($locale)) ?></h6>
                        <div class="mb-2">
                            <label class="form-label small">Title</label>
                            <input type="text" name="route_<?= e($route) ?>_<?= e($locale) ?>_title" class="form-control form-control-sm"
                                   value="<?= e($d['title'] ?? '') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Description</label>
                            <textarea name="route_<?= e($route) ?>_<?= e($locale) ?>_desc" class="form-control form-control-sm" rows="2"><?= e($d['description'] ?? '') ?></textarea>
                        </div>
                        <div>
                            <label class="form-label small">Robots</label>
                            <select name="route_<?= e($route) ?>_<?= e($locale) ?>_robots" class="form-select form-select-sm">
                                <option value="index, follow" <?= ($d['robots'] ?? '') === 'index, follow' ? 'selected' : '' ?>>index, follow</option>
                                <option value="noindex, follow" <?= ($d['robots'] ?? '') === 'noindex, follow' ? 'selected' : '' ?>>noindex, follow</option>
                                <option value="noindex, nofollow" <?= ($d['robots'] ?? '') === 'noindex, nofollow' ? 'selected' : '' ?>>noindex, nofollow</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-dark mt-3"><i class="bi bi-check me-2"></i>Сохранить SEO разделов</button>
        </form>
    </div>
</div>
