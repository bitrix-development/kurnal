<?php
/**
 * Admin dashboard
 * @var array $stats
 */
?>
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-0">Дашборд</h2>
        <p class="text-muted">Обзор контента сайта</p>
    </div>
</div>

<div class="row gy-4">
    <?php foreach ($stats as $label => $count): ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-number"><?= e((string)$count) ?></div>
            <p class="text-muted mb-0 mt-2"><?= e($label) ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="row mt-5">
    <div class="col-12">
        <h4>Быстрые ссылки</h4>
        <div class="d-flex gap-3 flex-wrap mt-3">
            <a href="/admin/news/create" class="btn btn-dark"><i class="bi bi-plus me-2"></i>Добавить новость</a>
            <a href="/admin/blog/create" class="btn btn-dark"><i class="bi bi-plus me-2"></i>Добавить статью</a>
            <a href="/admin/rooms/create" class="btn btn-dark"><i class="bi bi-plus me-2"></i>Добавить номер</a>
            <a href="/admin/services/create" class="btn btn-dark"><i class="bi bi-plus me-2"></i>Добавить услугу</a>
            <a href="/admin/gallery/create" class="btn btn-dark"><i class="bi bi-plus me-2"></i>Добавить фото</a>
            <a href="/admin/seo" class="btn btn-outline-dark"><i class="bi bi-graph-up me-2"></i>SEO настройки</a>
            <a href="/admin/settings" class="btn btn-outline-dark"><i class="bi bi-gear me-2"></i>Настройки</a>
        </div>
    </div>
</div>
