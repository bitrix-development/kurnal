<?php
/**
 * Breadcrumbs partial
 * @var array  $breadcrumbs  [['label'=>'...', 'url'=>'...'|null], ...]
 * @var string $locale
 */
$breadcrumbs = $breadcrumbs ?? [];
$locale = $locale ?? 'ru';
?>
<div class="breadcrumb-section mb-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <ul class="breadcrumb-list">
                        <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
                        <?php foreach ($breadcrumbs as $crumb): ?>
                            <li>
                                <?php if (!empty($crumb['url'])): ?>
                                    <a href="<?= e($crumb['url']) ?>"><?= e($crumb['label']) ?></a>
                                <?php else: ?>
                                    <span><?= e($crumb['label']) ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
