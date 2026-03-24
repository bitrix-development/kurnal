<?php $locale = $locale ?? 'ru'; $title = \App\Models\Page::getTitle($page, $locale); $body = \App\Models\Page::getBody($page, $locale); ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
    <li><span><?= e($title) ?></span></li>
</ul></div></div>
<div class="page-content-section mb-130"><div class="container">
    <div class="row"><div class="col-lg-12">
        <h1><?= e($title) ?></h1>
        <div class="page-body mt-40"><?= $body ?></div>
    </div></div>
</div></div>
