<?php
/**
 * News detail page
 * @var array  $item
 * @var string $locale
 */
$locale = $locale ?? 'ru';
$title  = \App\Models\News::getTitle($item, $locale);
$body   = \App\Models\News::getBody($item, $locale);
$excerpt = \App\Models\News::getExcerpt($item, $locale);
?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<!-- Breadcrumb -->
<div class="breadcrumb-section mb-130">
    <div class="container">
        <div class="breadcrumb-content">
            <ul class="breadcrumb-list">
                <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
                <li><a href="<?= url('news') ?>"><?= e(t('nav.news')) ?></a></li>
                <li><span><?= e(truncate($title, 60)) ?></span></li>
            </ul>
        </div>
    </div>
</div>

<!-- News Detail Section Start -->
<div class="blog-details-section-content mb-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-meta" style="margin-bottom:30px;display:flex;align-items:center;justify-content:space-between;">
                    <div class="blog-date">
                        <span style="display:block;color:var(--text-color);font-size:14px;margin-bottom:8px;"><?= e(t('common.date')) ?></span>
                        <strong><?= e(format_date($item['published_at'] ?? $item['created_at'], $locale)) ?></strong>
                    </div>
                </div>

                <h1><?= e($title) ?></h1>

                <?php if ($excerpt): ?>
                    <p class="lead"><?= e($excerpt) ?></p>
                <?php endif; ?>

                <?php if (!empty($item['image'])): ?>
                    <div class="mb-40">
                        <img src="<?= e(uploads_url($item['image'])) ?>" alt="<?= e($title) ?>" class="img-fluid w-100" style="border-radius:8px;">
                    </div>
                <?php endif; ?>

                <?php if ($body): ?>
                    <div class="news-details-text">
                        <?= $body ?>
                    </div>
                <?php endif; ?>

                <div class="mt-40">
                    <a href="<?= url('news') ?>" class="primary-btn1 btn-hover">
                        ← <?= e(t('common.back')) ?>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- News Detail Section End -->
