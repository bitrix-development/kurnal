<?php
/**
 * Universal admin list view
 * @var array  $items
 * @var int    $total
 * @var int    $currentPage
 * @var int    $lastPage
 * @var string $routePrefix
 * @var string $entity
 */
$locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');

// Labels mapping
$entityLabels = [
    'news'        => ['single' => 'Новость',    'plural' => 'Новости'],
    'blog_posts'  => ['single' => 'Статья',     'plural' => 'Блог'],
    'rooms'       => ['single' => 'Номер',      'plural' => 'Номера'],
    'services'    => ['single' => 'Услуга',     'plural' => 'Услуги'],
    'events'      => ['single' => 'Событие',    'plural' => 'События'],
    'auctions'    => ['single' => 'Закупка',    'plural' => 'Закупки'],
    'sanatoriums' => ['single' => 'Санаторий',  'plural' => 'Санатории'],
    'gallery'     => ['single' => 'Фото',       'plural' => 'Галерея'],
    'reviews'     => ['single' => 'Отзыв',      'plural' => 'Отзывы'],
    'pages'       => ['single' => 'Страница',   'plural' => 'Страницы'],
];

$labels = $entityLabels[$entity] ?? ['single' => $entity, 'plural' => $entity];
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0"><?= e($labels['plural']) ?></h2>
        <p class="text-muted mb-0"><?= e($total) ?> записей</p>
    </div>
    <a href="<?= e($routePrefix) ?>/create" class="btn btn-dark">
        <i class="bi bi-plus me-2"></i>Добавить
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Заголовок</th>
                        <th>Slug</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th width="120">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= e((string)$item['id']) ?></td>
                        <td>
                            <?php
                            $title = $item['title_ru'] ?? $item['name_ru'] ?? $item['title'] ?? $item['author'] ?? '—';
                            echo e(truncate($title, 60));
                            ?>
                        </td>
                        <td><code><?= e($item['slug'] ?? '—') ?></code></td>
                        <td>
                            <?php $status = $item['status'] ?? '—'; ?>
                            <span class="badge <?= in_array($status, ['published', 'active', 'approved']) ? 'bg-success' : 'bg-secondary' ?>">
                                <?= e($status) ?>
                            </span>
                        </td>
                        <td><?= e(substr($item['created_at'] ?? '—', 0, 10)) ?></td>
                        <td>
                            <a href="<?= e($routePrefix) ?>/<?= e((string)$item['id']) ?>/edit" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="post" action="<?= e($routePrefix) ?>/<?= e((string)$item['id']) ?>/delete" class="d-inline"
                                  onsubmit="return confirm('Удалить?')">
                                <?= \App\Services\CsrfService::field() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($items)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Записей нет</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<?php if ($lastPage > 1): ?>
<div class="mt-4 d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $lastPage; $i++): ?>
            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<?php endif; ?>
