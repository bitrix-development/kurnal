<?php
/**
 * Main layout
 * @var \App\Services\SeoService $seo
 * @var string $content
 * @var string $locale
 * @var string $app_url
 * @var array  $locales
 */
$locale  = $locale ?? 'ru';
$locales = $locales ?? ['ru', 'en'];
?>
<!doctype html>
<html lang="<?= e($locale) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <?= isset($seo) ? $seo->renderMeta() : '<title>Курорт Нальчик</title>' ?>

    <!-- Alternate languages -->
    <?php foreach ($locales as $loc): ?>
    <link rel="alternate" hreflang="<?= e($loc) ?>" href="<?= e(locale_url($loc)) ?>">
    <?php endforeach; ?>

    <!-- Bootstrap CSS -->
    <link href="<?= asset('css/bootstrap.min-1.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/jquery-ui-1.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/bootstrap-icons-1.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/animate.min-1.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/jquery.fancybox.min-1.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/nice-select-1.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/swiper-bundle.min-1.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/bootstrap-datetimepicker.min-1.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/daterangepicker-1.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/slick-1.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/slick-theme-1.css') ?>">
    <link href="<?= asset('css/boxicons.min-1.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style-1.css') ?>">
    <link rel="icon" href="<?= asset('fav-icon-1.svg') ?>" type="image/svg+xml">
</head>

<body class="tt-magic-cursor <?= $bodyClass ?? '' ?>">

<div id="magic-cursor"><div id="ball"></div></div>

<!-- Back To Top -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
    <svg class="arrow" width="22" height="25" viewBox="0 0 24 23" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.556131 11.4439L11.8139 0.186067L13.9214 2.29352L13.9422 20.6852L9.70638 20.7061L9.76793 8.22168L3.6064 14.4941L0.556131 11.4439Z"></path>
        <path d="M23.1276 11.4999L16.0288 4.40105L15.9991 10.4203L20.1031 14.5243L23.1276 11.4999Z"></path>
    </svg>
</div>

<?= $content ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<!-- Scripts -->
<script src="<?= asset('js/jquery-3.7.1.min-1.js') ?>"></script>
<script src="<?= asset('js/jquery-ui-1.js') ?>"></script>
<script src="<?= asset('js/moment.min-1.js') ?>"></script>
<script src="<?= asset('js/daterangepicker.min-1.js') ?>"></script>
<script src="<?= asset('js/bootstrap.min-1.js') ?>"></script>
<script src="<?= asset('js/popper.min-1.js') ?>"></script>
<script src="<?= asset('js/swiper-bundle.min-1.js') ?>"></script>
<script src="<?= asset('js/slick-1.js') ?>"></script>
<script src="<?= asset('js/waypoints.min-1.js') ?>"></script>
<script src="<?= asset('js/jquery.counterup.min-1.js') ?>"></script>
<script src="<?= asset('js/jquery.counterup.js') ?>"></script>
<script src="<?= asset('js/wow.min-1.js') ?>"></script>
<script src="<?= asset('js/circletype.min.js') ?>"></script>
<script src="<?= asset('js/jquery.nice-select.min-1.js') ?>"></script>
<script src="<?= asset('js/gsap.min-1.js') ?>"></script>
<script src="<?= asset('js/ScrollTrigger.min-1.js') ?>"></script>
<script src="<?= asset('js/jquery.fancybox.min-1.js') ?>"></script>
<script src="<?= asset('js/ScrambleTextPlugin.min.js') ?>"></script>
<script src="<?= asset('js/SplitText.min.js') ?>"></script>
<script src="<?= asset('js/custom-1.js') ?>"></script>
</body>
</html>
