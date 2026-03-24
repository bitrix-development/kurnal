<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li><li><span><?= e(t('nav.events')) ?></span></li>
</ul></div></div>
<section class="list-section mb-130"><div class="container">
    <div class="row mb-60"><div class="col-12 text-center"><h1><?= e(t('nav.events')) ?></h1></div></div>
    <div class="row gy-5">
    <?php foreach ($items as $item): ?>
        <div class="col-lg-4 col-md-6">
            <div class="item-card" style="border:1px solid #eee;border-radius:12px;overflow:hidden;">
                <?php if (!empty($item['image'])): ?>
                    <img src="<?= e(uploads_url($item['image'])) ?>" alt="" class="img-fluid w-100" style="height:200px;object-fit:cover;">
                <?php endif; ?>
                <div class="p-3">
                    <h4><a href="<?= e(url('events/' . $item['slug'])) ?>"><?= e($item['title_' . $locale] ?: $item['title_ru'] ?? $item['name_' . $locale] ?? '') ?></a></h4>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (empty($items)): ?><div class="col-12 text-center"><p>Нет данных.</p></div><?php endif; ?>
    </div>
    <?php include __DIR__ . '/../partials/pagination.php'; ?>
</div></section>
