<?php $locale = $locale ?? 'ru'; $name = \App\Models\Service::getName($item,$locale); $body = \App\Models\Service::getBody($item,$locale); ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
    <li><a href="<?= url('services') ?>"><?= e(t('nav.services')) ?></a></li>
    <li><span><?= e($name) ?></span></li>
</ul></div></div>
<div class="service-detail-section mb-130"><div class="container">
    <h1><?= e($name) ?></h1>
    <?php if (!empty($item['image'])): ?><img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e($name) ?>" class="img-fluid w-100 mb-40" style="border-radius:8px;"><?php endif; ?>
    <div><?= $body ?: \App\Models\Service::getDescription($item,$locale) ?></div>
    <div class="mt-40"><a href="<?= url('services') ?>" class="primary-btn1 btn-hover">← <?= e(t('common.back')) ?><span></span></a></div>
</div></div>
