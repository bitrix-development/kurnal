<?php $locale = $locale ?? 'ru'; $name = \App\Models\Room::getName($item,$locale); $desc = \App\Models\Room::getDescription($item,$locale); ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
    <li><a href="<?= url('rooms') ?>"><?= e(t('nav.rooms')) ?></a></li>
    <li><span><?= e($name) ?></span></li>
</ul></div></div>
<div class="room-detail-section mb-130"><div class="container"><div class="row gy-5">
    <div class="col-lg-8">
        <h1><?= e($name) ?></h1>
        <?php if (!empty($item['image'])): ?>
            <img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e($name) ?>" class="img-fluid w-100 mb-40" style="border-radius:8px;">
        <?php endif; ?>
        <div><?= $desc ?></div>
        <?php $features = \App\Models\Room::getFeatures($item, $locale); if ($features): ?>
            <h3 class="mt-40">Особенности</h3><div><?= $features ?></div>
        <?php endif; ?>
    </div>
    <div class="col-lg-4">
        <div class="sidebar" style="background:#f8f8f8;padding:30px;border-radius:12px;">
            <?php if (!empty($item['price_from'])): ?>
                <p class="mb-10"><?= e(t('common.price_from')) ?>:</p>
                <h3><?= e($item['price_from']) ?> ₽ <small style="font-size:14px;"><?= e(t('common.per_night')) ?></small></h3>
            <?php endif; ?>
            <a href="<?= url('contact') ?>" class="primary-btn1 btn-hover mt-20 d-block text-center"><?= e(t('common.book_now')) ?><span></span></a>
        </div>
    </div>
</div></div></div>
