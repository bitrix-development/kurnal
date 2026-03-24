<?php
/**
 * Home page view
 * @var \App\Services\SeoService $seo
 * @var array $latestNews
 * @var array $latestBlog
 * @var string $locale
 */
$locale = $locale ?? 'ru';
?>

<!-- header Book Now Wrap Area Section Start -->
<div class="header-offer-topbar-wrap home1-header">
    <div class="offer-topbar">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="offer-text-slider-wrap">
                        <div class="slider-btn get-offer-text-slider-prev">
                            <svg width="16" height="16" viewBox="0 0 16 16"><path d="M5.66394 7.62699C5.66343 7.71473 5.68025 7.8017 5.71342 7.88293C5.7466 7.96415 5.79548 8.03803 5.85727 8.10033L9.85727 12.1003C9.98281 12.2259 10.1531 12.2964 10.3306 12.2964C10.5081 12.2964 10.6784 12.2259 10.8039 12.1003C10.9295 11.9748 11 11.8045 11 11.627C11 11.4495 10.9295 11.2792 10.8039 11.1537L7.27061 7.62699L10.7973 4.10033C10.9065 3.97279 10.9636 3.80874 10.9571 3.64096C10.9506 3.47317 10.881 3.31401 10.7623 3.19528C10.6436 3.07655 10.4844 3.007 10.3166 3.00052C10.1489 2.99404 9.98481 3.05111 9.85727 3.16032L5.85727 7.16033C5.73411 7.2845 5.66467 7.4521 5.66394 7.62699Z"></path></svg>
                        </div>
                        <div class="swiper get-offer-text-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><a href="#">Закажите бронь сейчас и получите скидку</a></div>
                                <div class="swiper-slide"><a href="#">Специальное предложение для молодожёнов</a></div>
                                <div class="swiper-slide"><a href="#">При размещении сроком на 6 дней, 7 день - бесплатно</a></div>
                            </div>
                        </div>
                        <div class="slider-btn get-offer-text-slider-next">
                            <svg width="16" height="16" viewBox="0 0 16 16"><path d="M10.3361 7.62699C10.3366 7.71473 10.3198 7.8017 10.2866 7.88293C10.2534 7.96415 10.2045 8.03803 10.1427 8.10033L6.14273 12.1003C6.01719 12.2259 5.84693 12.2964 5.6694 12.2964C5.49186 12.2964 5.3216 12.2259 5.19606 12.1003C5.07053 11.9748 5 11.8045 5 11.627C5 11.4495 5.07053 11.2792 5.19606 11.1537L8.7294 7.62699L5.20273 4.10033C5.09351 3.97279 5.03644 3.80874 5.04292 3.64096C5.0494 3.47317 5.11896 3.31401 5.23769 3.19528C5.35642 3.07655 5.51558 3.007 5.68336 3.00052C5.85114 2.99404 6.01519 3.05111 6.14273 3.16032L10.1427 7.16033C10.2659 7.2845 10.3353 7.4521 10.3361 7.62699Z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offer-topbar-close-btn"><i class="bi bi-x"></i></div>
    </div>
    <?php include __DIR__ . '/../partials/header.php'; ?>
</div>
<!-- header Book Now Wrap Area Section End -->

<!-- Banner Section Start -->
<div class="home1-banner-section">
    <div class="row">
        <div class="col-lg-12">
            <div class="swiper home1-banner-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="banner-wrapper">
                            <div class="banner-img-area">
                                <img src="<?= asset('img/home1/banner-img1.jpg') ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="banner-wrapper">
                            <div class="banner-img-area">
                                <img src="<?= asset('img/home1/banner-img2.jpg') ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="banner-wrapper">
                            <div class="banner-img-area">
                                <img src="<?= asset('img/home1/banner-img5.jpg') ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-content-wrap wow animate fadeInDown" data-wow-delay="400ms" data-wow-duration="1500ms">
        <div class="container">
            <div class="banner-content">
                <div class="span-tag">
                    <span>Запланируйте свой отпуск уже сегодня</span>
                </div>
                <h1 style="font-size:52px;">Гармония с природой и исключительный комфорт</h1>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section End -->

<!-- Latest News Section -->
<?php if (!empty($latestNews)): ?>
<div class="home1-blog-section mb-130">
    <div class="container">
        <div class="row mb-60">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2><?= e(t('nav.news')) ?></h2>
                </div>
            </div>
        </div>
        <div class="row gy-5">
            <?php foreach ($latestNews as $news): ?>
            <div class="col-lg-4 col-md-6">
                <div class="magnetic-wrap">
                    <div class="blog-card magnetic-item">
                        <a class="blog-img" href="<?= e(url('news/' . $news['slug'])) ?>">
                            <?php if (!empty($news['image'])): ?>
                                <img src="<?= e(uploads_url($news['image'])) ?>" alt="<?= e(\App\Models\News::getTitle($news, $locale)) ?>">
                            <?php else: ?>
                                <img src="<?= asset('img/home1/blog-img1-1.jpg') ?>" alt="">
                            <?php endif; ?>
                        </a>
                        <div class="blog-card-content">
                            <div class="date-and-event">
                                <a href="<?= e(url('news/' . $news['slug'])) ?>"><?= e($news['category'] ?? '') ?></a>
                                <a href="#"><?= e(format_date($news['published_at'] ?? $news['created_at'], $locale)) ?></a>
                            </div>
                            <h4><a href="<?= e(url('news/' . $news['slug'])) ?>"><?= e(\App\Models\News::getTitle($news, $locale)) ?></a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row mt-60">
            <div class="col-lg-12 d-flex justify-content-center">
                <a class="primary-btn1 btn-hover black-bg" href="<?= url('news') ?>">
                    <?= e(t('common.see_all')) ?><span></span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
