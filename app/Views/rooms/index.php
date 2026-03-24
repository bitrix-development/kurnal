<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li><li><span><?= e(t('nav.rooms')) ?></span></li>
</ul></div></div>
<section class="room-list-section mb-130"><div class="container">
    <div class="row mb-60"><div class="col-12 text-center"><h1><?= e(t('nav.rooms')) ?></h1></div></div>
    <div class="row gy-5">
    <?php foreach ($items as $item): ?>
        <div class="col-lg-4 col-md-6">
            <div class="room-card">
                <a href="<?= e(url('rooms/' . $item['slug'])) ?>">
                    <?php if (!empty($item['image'])): ?>
                        <img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e(\App\Models\Room::getName($item,$locale)) ?>" class="img-fluid w-100" style="border-radius:8px;height:250px;object-fit:cover;">
                    <?php endif; ?>
                </a>
                <div class="p-3">
                    <h4><a href="<?= e(url('rooms/' . $item['slug'])) ?>"><?= e(\App\Models\Room::getName($item,$locale)) ?></a></h4>
                    <?php if (!empty($item['price_from'])): ?>
                        <p><?= e(t('common.price_from')) ?>: <strong><?= e($item['price_from']) ?> ₽</strong></p>
                    <?php endif; ?>
                    <a href="<?= e(url('rooms/' . $item['slug'])) ?>" class="primary-btn1 btn-hover"><?= e(t('common.read_more')) ?><span></span></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (empty($items)): ?><div class="col-12 text-center"><p>Номеров пока нет.</p></div><?php endif; ?>
    </div>
    <?php include __DIR__ . '/../partials/pagination.php'; ?>
</div></section>
