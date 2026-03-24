<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li><li><span><?= e(t('nav.gallery')) ?></span></li>
</ul></div></div>
<section class="gallery-section mb-130"><div class="container">
    <div class="row mb-60"><div class="col-12 text-center"><h1><?= e(t('nav.gallery')) ?></h1></div></div>
    <div class="row gy-4">
    <?php foreach ($items as $item): ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="gallery-item">
                <?php if (!empty($item['image'])): ?>
                    <a href="<?= e(uploads_url($item['image'])) ?>" data-fancybox="gallery" data-caption="<?= e(\App\Models\Gallery::getTitle($item, $locale)) ?>">
                        <img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e(\App\Models\Gallery::getTitle($item, $locale)) ?>" class="img-fluid w-100" style="border-radius:8px;height:250px;object-fit:cover;">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div></section>
