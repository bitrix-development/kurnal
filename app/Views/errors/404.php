<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<section class="error-section" style="min-height:60vh;display:flex;align-items:center;">
    <div class="container text-center">
        <h1 style="font-size:120px;font-weight:700;color:#2c2c2c;">404</h1>
        <h2><?= e(t('page_404.title')) ?></h2>
        <p class="mt-20"><?= e(t('page_404.text')) ?></p>
        <a href="<?= url() ?>" class="primary-btn1 btn-hover mt-30"><?= e(t('page_404.button')) ?><span></span></a>
    </div>
</section>
