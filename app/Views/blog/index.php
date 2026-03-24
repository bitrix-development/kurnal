<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><div class="breadcrumb-content"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
    <li><span><?= e(t('nav.blog')) ?></span></li>
</ul></div></div></div>
<div class="home1-blog-section mb-130"><div class="container">
    <div class="row mb-60"><div class="col-lg-12 text-center"><h1><?= e(t('nav.blog')) ?></h1></div></div>
    <div class="row gy-5">
    <?php foreach ($items as $item): ?>
        <div class="col-lg-4 col-md-6">
            <div class="blog-card">
                <a class="blog-img" href="<?= e(url('blog/' . $item['slug'])) ?>">
                    <?php if (!empty($item['image'])): ?>
                        <img src="<?= e(uploads_url($item['image'])) ?>" alt="">
                    <?php else: ?>
                        <img src="<?= asset('img/home1/blog-img1-1.jpg') ?>" alt="">
                    <?php endif; ?>
                </a>
                <div class="blog-card-content">
                    <div class="date-and-event">
                        <a href="#"><?= e(format_date($item['published_at'] ?? $item['created_at'], $locale)) ?></a>
                    </div>
                    <h4><a href="<?= e(url('blog/' . $item['slug'])) ?>"><?= e(\App\Models\Blog::getTitle($item, $locale)) ?></a></h4>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (empty($items)): ?><div class="col-12 text-center"><p>Статей пока нет.</p></div><?php endif; ?>
    </div>
    <?php include __DIR__ . '/../partials/pagination.php'; ?>
</div></div>
