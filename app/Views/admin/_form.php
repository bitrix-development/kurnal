<?php
/**
 * Universal admin form view
 * @var array|null $item
 * @var array      $errors
 * @var string     $routePrefix
 * @var string     $entity
 */
$locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
$isEdit  = !empty($item['id']);
$action  = $isEdit ? $routePrefix . '/' . $item['id'] . '/update' : $routePrefix . '/store';

// Entity config
$entityConfig = [
    'news'        => ['title_fields' => ['title'], 'body_fields' => ['excerpt', 'body'], 'simple' => ['slug', 'status', 'image', 'published_at', 'category']],
    'blog_posts'  => ['title_fields' => ['title'], 'body_fields' => ['excerpt', 'body'], 'simple' => ['slug', 'status', 'image', 'published_at']],
    'rooms'       => ['title_fields' => ['name'], 'body_fields' => ['description', 'features'], 'simple' => ['slug', 'status', 'image', 'price_from', 'sort_order']],
    'services'    => ['title_fields' => ['name'], 'body_fields' => ['description', 'body'], 'simple' => ['slug', 'status', 'image', 'sort_order']],
    'events'      => ['title_fields' => ['title'], 'body_fields' => ['excerpt', 'body'], 'simple' => ['slug', 'status', 'image', 'event_date']],
    'auctions'    => ['title_fields' => ['title'], 'body_fields' => ['excerpt', 'body'], 'simple' => ['slug', 'status', 'image', 'auction_date', 'price']],
    'sanatoriums' => ['title_fields' => ['name'], 'body_fields' => ['description', 'body'], 'simple' => ['slug', 'status', 'image', 'sort_order']],
    'gallery'     => ['title_fields' => ['title'], 'body_fields' => [], 'simple' => ['status', 'sort_order', 'image']],
    'reviews'     => ['title_fields' => [], 'body_fields' => [], 'simple' => ['author', 'rating', 'text', 'status']],
    'pages'       => ['title_fields' => ['title'], 'body_fields' => ['body'], 'simple' => ['slug', 'status']],
];
$cfg = $entityConfig[$entity] ?? ['title_fields' => ['title'], 'body_fields' => ['body'], 'simple' => ['slug', 'status', 'image']];

$entityNames = [
    'news'=>'Новость','blog_posts'=>'Статья','rooms'=>'Номер','services'=>'Услуга',
    'events'=>'Событие','auctions'=>'Закупка','sanatoriums'=>'Санаторий',
    'gallery'=>'Фото','reviews'=>'Отзыв','pages'=>'Страница',
];
$entityName = $entityNames[$entity] ?? $entity;
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0"><?= $isEdit ? 'Редактировать' : 'Добавить' ?> — <?= e($entityName) ?></h2>
    </div>
    <a href="<?= e($routePrefix) ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Назад
    </a>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= e($action) ?>" enctype="multipart/form-data">
<div class="row gy-4">
    <!-- Left column: translatable fields -->
    <div class="col-lg-8">

        <?php if (!empty($cfg['title_fields'])): ?>
        <!-- Language tabs -->
        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="langTabs" role="tablist">
                    <?php foreach ($locales as $i => $locale): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $i === 0 ? 'active' : '' ?>"
                                id="tab-<?= e($locale) ?>" data-bs-toggle="tab"
                                data-bs-target="#tab-content-<?= e($locale) ?>" type="button" role="tab">
                            <?= strtoupper(e($locale)) ?>
                        </button>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="langTabsContent">
                    <?php foreach ($locales as $i => $locale): ?>
                    <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="tab-content-<?= e($locale) ?>" role="tabpanel">

                        <?php foreach ($cfg['title_fields'] as $field): ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <?= ucfirst($field) ?> (<?= strtoupper(e($locale)) ?>)
                                <?= $locale === 'ru' ? '<span class="text-danger">*</span>' : '' ?>
                            </label>
                            <input type="text"
                                   name="<?= e($field . '_' . $locale) ?>"
                                   class="form-control"
                                   value="<?= e($item[$field . '_' . $locale] ?? '') ?>">
                        </div>
                        <?php endforeach; ?>

                        <?php foreach ($cfg['body_fields'] as $field): ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?= ucfirst($field) ?> (<?= strtoupper(e($locale)) ?>)</label>
                            <?php if ($field === 'body'): ?>
                                <textarea name="<?= e($field . '_' . $locale) ?>" class="form-control wysiwyg" rows="15"><?= e($item[$field . '_' . $locale] ?? '') ?></textarea>
                                <div class="form-text">HTML разметка поддерживается. Используйте теги: &lt;p&gt;, &lt;h2&gt;, &lt;ul&gt;, &lt;a&gt;, &lt;img&gt; и др.</div>
                            <?php else: ?>
                                <textarea name="<?= e($field . '_' . $locale) ?>" class="form-control" rows="4"><?= e($item[$field . '_' . $locale] ?? '') ?></textarea>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- SEO Override -->
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="bi bi-graph-up me-2"></i>SEO настройки
                <small class="text-muted ms-2">(переопределение для этого элемента)</small>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="seoTabs" role="tablist">
                    <?php foreach ($locales as $i => $locale): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $i === 0 ? 'active' : '' ?>"
                                id="seo-tab-<?= e($locale) ?>" data-bs-toggle="tab"
                                data-bs-target="#seo-content-<?= e($locale) ?>" type="button">
                            SEO <?= strtoupper(e($locale)) ?>
                        </button>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($locales as $i => $locale): ?>
                    <?php $seoData = $item['seo'][$locale] ?? []; ?>
                    <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="seo-content-<?= e($locale) ?>">
                        <div class="mb-3">
                            <label class="form-label">Meta Title (<?= strtoupper(e($locale)) ?>)</label>
                            <input type="text" name="seo_title_<?= e($locale) ?>" class="form-control"
                                   value="<?= e($seoData['title'] ?? '') ?>"
                                   placeholder="Заголовок страницы — если пусто, берётся из шаблона">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description (<?= strtoupper(e($locale)) ?>)</label>
                            <textarea name="seo_description_<?= e($locale) ?>" class="form-control" rows="3"
                                      placeholder="Описание — если пусто, берётся из шаблона"><?= e($seoData['description'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Robots</label>
                            <select name="seo_robots_<?= e($locale) ?>" class="form-select">
                                <option value="index, follow" <?= ($seoData['robots'] ?? '') === 'index, follow' ? 'selected' : '' ?>>index, follow</option>
                                <option value="noindex, follow" <?= ($seoData['robots'] ?? '') === 'noindex, follow' ? 'selected' : '' ?>>noindex, follow</option>
                                <option value="noindex, nofollow" <?= ($seoData['robots'] ?? '') === 'noindex, nofollow' ? 'selected' : '' ?>>noindex, nofollow</option>
                            </select>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div><!-- /col-lg-8 -->

    <!-- Right column: simple fields -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">Публикация</div>
            <div class="card-body">

                <?php if (in_array('status', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Статус</label>
                    <select name="status" class="form-select">
                        <?php
                        $statusOptions = [
                            'news'       => ['published' => 'Опубликован', 'draft' => 'Черновик'],
                            'blog_posts' => ['published' => 'Опубликован', 'draft' => 'Черновик'],
                            'rooms'      => ['active' => 'Активен', 'inactive' => 'Неактивен'],
                            'services'   => ['active' => 'Активна', 'inactive' => 'Неактивна'],
                            'events'     => ['published' => 'Опубликовано', 'draft' => 'Черновик'],
                            'auctions'   => ['published' => 'Опубликован', 'draft' => 'Черновик'],
                            'sanatoriums'=> ['active' => 'Активен', 'inactive' => 'Неактивен'],
                            'gallery'    => ['active' => 'Активно', 'inactive' => 'Неактивно'],
                            'reviews'    => ['approved' => 'Одобрен', 'pending' => 'На модерации', 'rejected' => 'Отклонён'],
                            'pages'      => ['published' => 'Опубликована', 'draft' => 'Черновик'],
                        ];
                        $opts = $statusOptions[$entity] ?? ['published' => 'Опубликован', 'draft' => 'Черновик'];
                        foreach ($opts as $val => $label):
                            $selected = ($item['status'] ?? array_key_first($opts)) === $val ? 'selected' : '';
                        ?>
                        <option value="<?= e($val) ?>" <?= $selected ?>><?= e($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>

                <?php if (in_array('published_at', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Дата публикации</label>
                    <input type="datetime-local" name="published_at" class="form-control"
                           value="<?= e(str_replace(' ', 'T', $item['published_at'] ?? date('Y-m-d H:i:s'))) ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('event_date', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Дата события</label>
                    <input type="datetime-local" name="event_date" class="form-control"
                           value="<?= e(str_replace(' ', 'T', $item['event_date'] ?? '')) ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('auction_date', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Дата закупки</label>
                    <input type="datetime-local" name="auction_date" class="form-control"
                           value="<?= e(str_replace(' ', 'T', $item['auction_date'] ?? '')) ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('slug', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug (URL)</label>
                    <input type="text" name="slug" class="form-control"
                           value="<?= e($item['slug'] ?? '') ?>"
                           placeholder="авто-генерация если пусто">
                    <div class="form-text">Используйте латиницу, цифры и дефисы</div>
                </div>
                <?php endif; ?>

                <?php if (in_array('category', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Категория</label>
                    <input type="text" name="category" class="form-control" value="<?= e($item['category'] ?? '') ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('price_from', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Цена от (₽)</label>
                    <input type="number" name="price_from" class="form-control" value="<?= e($item['price_from'] ?? '') ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('price', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Цена (₽)</label>
                    <input type="text" name="price" class="form-control" value="<?= e($item['price'] ?? '') ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('sort_order', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Порядок сортировки</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= e($item['sort_order'] ?? '0') ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('rating', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Рейтинг</label>
                    <select name="rating" class="form-select">
                        <?php for ($r = 1; $r <= 5; $r++): ?>
                        <option value="<?= $r ?>" <?= ($item['rating'] ?? 5) == $r ? 'selected' : '' ?>><?= $r ?> ★</option>
                        <?php endfor; ?>
                    </select>
                </div>
                <?php endif; ?>

                <?php if (in_array('author', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Автор</label>
                    <input type="text" name="author" class="form-control" value="<?= e($item['author'] ?? '') ?>">
                </div>
                <?php endif; ?>

                <?php if (in_array('text', $cfg['simple'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Текст отзыва</label>
                    <textarea name="text" class="form-control" rows="5"><?= e($item['text'] ?? '') ?></textarea>
                </div>
                <?php endif; ?>

                <div class="mb-3">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-check me-2"></i><?= $isEdit ? 'Сохранить' : 'Создать' ?>
                    </button>
                </div>
            </div>
        </div>

        <?php if (in_array('image', $cfg['simple'])): ?>
        <div class="card">
            <div class="card-header">Изображение</div>
            <div class="card-body">
                <?php if (!empty($item['image'])): ?>
                    <div class="mb-3">
                        <img src="/uploads/<?= e($item['image']) ?>" alt="" class="img-fluid w-100" style="border-radius:8px;max-height:200px;object-fit:cover;">
                        <small class="text-muted d-block mt-2"><?= e($item['image']) ?></small>
                    </div>
                <?php endif; ?>
                <div class="mb-0">
                    <label class="form-label fw-semibold">
                        <?= !empty($item['image']) ? 'Заменить изображение' : 'Загрузить изображение' ?>
                    </label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">JPEG, PNG, WebP. Макс. 10 МБ</div>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div><!-- /col-lg-4 -->
</div><!-- /row -->
</form>
