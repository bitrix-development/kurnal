<?php $locale = $locale ?? 'ru'; 
$title = $item['title_' . $locale] ?: $item['title_ru'] ?? $item['name_' . $locale] ?? '';
$body  = $item['body_' . $locale]  ?: $item['body_ru']  ?? '';
?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
    <li><a href="<?= url('auctions') ?>"><?= e(t('nav.auctions')) ?></a></li>
    <li><span><?= e(truncate($title,60)) ?></span></li>
</ul></div></div>
<div class="detail-section mb-130"><div class="container">
    <h1><?= e($title) ?></h1>
    <?php if (!empty($item['image'])): ?><img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e($title) ?>" class="img-fluid w-100 mb-40" style="border-radius:8px;"><?php endif; ?>
    <div><?= $body ?></div>
    <div class="mt-40"><a href="<?= url('auctions') ?>" class="primary-btn1 btn-hover">← <?= e(t('common.back')) ?><span></span></a></div>
</div></div>
