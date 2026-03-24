<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li><li><span><?= e(t('nav.services')) ?></span></li>
</ul></div></div>
<section class="services-section mb-130"><div class="container">
    <div class="row mb-60"><div class="col-12 text-center"><h1><?= e(t('nav.services')) ?></h1></div></div>
    <div class="row gy-5">
    <?php foreach ($items as $item): ?>
        <div class="col-lg-4 col-md-6">
            <div class="service-card" style="border:1px solid #eee;border-radius:12px;overflow:hidden;">
                <?php if (!empty($item['image'])): ?>
                    <img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e(\App\Models\Service::getName($item,$locale)) ?>" class="img-fluid w-100" style="height:200px;object-fit:cover;">
                <?php endif; ?>
                <div class="p-3">
                    <h4><a href="<?= e(url('services/' . $item['slug'])) ?>"><?= e(\App\Models\Service::getName($item,$locale)) ?></a></h4>
                    <p><?= e(truncate(\App\Models\Service::getDescription($item,$locale), 100)) ?></p>
                    <a href="<?= e(url('services/' . $item['slug'])) ?>" class="primary-btn1 btn-hover"><?= e(t('common.read_more')) ?><span></span></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div></section>
