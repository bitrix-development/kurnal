<?php
/**
 * Admin layout
 * @var string $content
 * @var string $app_url
 */
$adminUser = \App\Services\AuthService::user();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админпанель — Курорт Нальчик</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="<?= $app_url ?? '' ?>/assets/css/bootstrap.min-1.css" rel="stylesheet">
    <link href="<?= $app_url ?? '' ?>/assets/css/bootstrap-icons-1.css" rel="stylesheet">
    <style>
        body { background:#f4f6f9; font-family: 'DM Sans', sans-serif; }
        .admin-sidebar { width:250px; min-height:100vh; background:#1a1a2e; position:fixed; top:0; left:0; z-index:100; }
        .admin-sidebar .brand { padding:24px 20px; color:#fff; font-size:18px; font-weight:700; border-bottom:1px solid rgba(255,255,255,.1); }
        .admin-sidebar .nav-link { color:rgba(255,255,255,.75); padding:10px 20px; display:block; text-decoration:none; font-size:14px; }
        .admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active { color:#fff; background:rgba(255,255,255,.1); }
        .admin-sidebar .nav-section { padding:16px 20px 6px; color:rgba(255,255,255,.4); font-size:11px; text-transform:uppercase; letter-spacing:1px; }
        .admin-content { margin-left:250px; padding:30px; }
        .admin-topbar { background:#fff; border-bottom:1px solid #e9ecef; padding:15px 30px; margin-left:250px; position:sticky; top:0; z-index:99; display:flex; align-items:center; justify-content:space-between; }
        .card { border:none; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,.08); }
        .card-header { background:#fff; border-bottom:1px solid #f0f0f0; padding:18px 24px; font-weight:600; }
        .table th { font-size:13px; color:#6c757d; font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
        .btn-sm { font-size:12px; }
        .alert { border-radius:8px; }
        .wysiwyg-toolbar { background:#f8f9fa; border:1px solid #dee2e6; border-bottom:none; padding:8px; border-radius:6px 6px 0 0; }
        textarea.wysiwyg { border-radius:0 0 6px 6px; min-height:300px; font-family:monospace; }
        .stat-card { background:#fff; border-radius:12px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,.08); text-align:center; }
        .stat-number { font-size:48px; font-weight:700; color:#1a1a2e; }
        .nav-link i { margin-right:8px; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="admin-sidebar">
    <div class="brand">
        <i class="bi bi-building me-2"></i>Курорт Нальчик
    </div>
    <nav>
        <div class="nav-section">Управление</div>
        <a href="/admin" class="nav-link"><i class="bi bi-speedometer2"></i>Дашборд</a>
        <a href="/admin/pages" class="nav-link"><i class="bi bi-file-earmark-text"></i>Страницы</a>
        <a href="/admin/news" class="nav-link"><i class="bi bi-newspaper"></i>Новости</a>
        <a href="/admin/blog" class="nav-link"><i class="bi bi-pen"></i>Блог</a>
        <a href="/admin/rooms" class="nav-link"><i class="bi bi-door-open"></i>Номера</a>
        <a href="/admin/services" class="nav-link"><i class="bi bi-stars"></i>Услуги</a>
        <a href="/admin/events" class="nav-link"><i class="bi bi-calendar-event"></i>События</a>
        <a href="/admin/auctions" class="nav-link"><i class="bi bi-hammer"></i>Закупки</a>
        <a href="/admin/sanatoriums" class="nav-link"><i class="bi bi-hospital"></i>Санатории</a>
        <a href="/admin/gallery" class="nav-link"><i class="bi bi-images"></i>Галерея</a>
        <a href="/admin/reviews" class="nav-link"><i class="bi bi-star"></i>Отзывы</a>

        <div class="nav-section">Настройки</div>
        <a href="/admin/seo" class="nav-link"><i class="bi bi-graph-up"></i>SEO</a>
        <a href="/admin/settings" class="nav-link"><i class="bi bi-gear"></i>Настройки</a>

        <div class="nav-section">Аккаунт</div>
        <a href="/" target="_blank" class="nav-link"><i class="bi bi-eye"></i>Сайт</a>
        <a href="/admin/logout" class="nav-link"><i class="bi bi-box-arrow-right"></i>Выход</a>
    </nav>
</div>

<!-- Topbar -->
<div class="admin-topbar">
    <div></div>
    <div class="d-flex align-items-center gap-3">
        <span class="text-muted"><?= htmlspecialchars($adminUser['name'] ?? 'Admin', ENT_QUOTES) ?></span>
    </div>
</div>

<!-- Content -->
<div class="admin-content">
    <?php if (!empty($_GET['saved'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="bi bi-check-circle me-2"></i>Сохранено успешно!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (!empty($_GET['deleted'])): ?>
        <div class="alert alert-warning alert-dismissible fade show mb-4">
            <i class="bi bi-trash me-2"></i>Удалено.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?= $content ?>
</div>

<script src="<?= $app_url ?? '' ?>/assets/js/jquery-3.7.1.min-1.js"></script>
<script src="<?= $app_url ?? '' ?>/assets/js/bootstrap.min-1.js"></script>
</body>
</html>
