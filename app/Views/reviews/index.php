<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li><li><span><?= e(t('nav.reviews')) ?></span></li>
</ul></div></div>
<section class="reviews-section mb-130"><div class="container">
    <div class="row mb-60"><div class="col-12 text-center"><h1><?= e(t('nav.reviews')) ?></h1></div></div>
    <div class="row gy-5">
    <?php foreach ($items as $item): ?>
        <div class="col-lg-6">
            <div class="review-card" style="border:1px solid #eee;border-radius:12px;padding:24px;">
                <div class="d-flex align-items-center mb-15">
                    <strong><?= e($item['author']) ?></strong>
                    <?php if (!empty($item['rating'])): ?>
                        <span class="ms-auto" style="color:#f5a623;">
                            <?= str_repeat('★', (int)$item['rating']) . str_repeat('☆', 5 - (int)$item['rating']) ?>
                        </span>
                    <?php endif; ?>
                </div>
                <p><?= e($item['text']) ?></p>
                <small class="text-muted"><?= e(format_date($item['created_at'], $locale)) ?></small>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div></section>
