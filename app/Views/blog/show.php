<?php $locale = $locale ?? 'ru'; $title = \App\Models\Blog::getTitle($item, $locale); $body = \App\Models\Blog::getBody($item, $locale); ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
    <li><a href="<?= url('blog') ?>"><?= e(t('nav.blog')) ?></a></li>
    <li><span><?= e(truncate($title,60)) ?></span></li>
</ul></div></div>
<div class="blog-details-section-content mb-130"><div class="container"><div class="row"><div class="col-lg-12">
    <h1><?= e($title) ?></h1>
    <?php if (!empty($item['image'])): ?>
        <img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e($title) ?>" class="img-fluid w-100 mb-40" style="border-radius:8px;">
    <?php endif; ?>
    <div class="news-details-text"><?= $body ?></div>
    <div class="mt-40"><a href="<?= url('blog') ?>" class="primary-btn1 btn-hover">← <?= e(t('common.back')) ?><span></span></a></div>
</div></div></div></div>
