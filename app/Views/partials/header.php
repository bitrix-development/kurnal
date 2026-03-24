<?php
/**
 * Header partial — used on inner pages (not home)
 * @var string $locale
 * @var array  $locales
 */
$locale  = $locale ?? 'ru';
$locales = $locales ?? ['ru', 'en'];
?>
<!-- Header Section Start -->
<header class="header-area style-1 two">
    <div class="container-fluid d-flex flex-nowrap align-items-center justify-content-between">
        <div class="logo-and-menu-area">
            <a href="<?= url() ?>" class="header-logo">
                <img src="<?= asset('img/home2-header-logo-1.svg') ?>" alt="<?= e(t('nav.home')) ?>">
            </a>
            <div class="main-menu">
                <div class="mobile-logo-area d-xl-none d-flex align-items-center justify-content-between">
                    <a href="<?= url() ?>" class="mobile-logo-wrap">
                        <img src="<?= asset('img/home2-header-logo-1.svg') ?>" alt="">
                    </a>
                    <div class="menu-close-btn"><i class="bi bi-x"></i></div>
                </div>
                <ul class="menu-list">
                    <li class="menu-item"><a href="<?= url() ?>"><?= e(t('nav.home')) ?></a></li>
                    <li class="menu-item-has-children">
                        <a href="<?= url('rooms') ?>" class="drop-down"><?= e(t('nav.rooms')) ?> <i class="bi bi-caret-down-fill"></i></a>
                        <i class="bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="<?= url('rooms') ?>"><?= e(t('nav.rooms')) ?></a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="<?= url('services') ?>" class="drop-down"><?= e(t('nav.services')) ?> <i class="bi bi-caret-down-fill"></i></a>
                        <i class="bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="<?= url('services') ?>"><?= e(t('nav.services')) ?></a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="<?= url('news') ?>"><?= e(t('nav.news')) ?></a></li>
                    <li class="menu-item"><a href="<?= url('contact') ?>"><?= e(t('nav.contact')) ?></a></li>
                    <li class="menu-item"><a href="<?= url('blog') ?>"><?= e(t('nav.blog')) ?></a></li>
                </ul>
                <a class="primary-btn1 two btn-hover d-xl-none" href="<?= url('contact') ?>">
                    <?= e(t('nav.book')) ?><span></span>
                </a>
            </div>
        </div>
        <div class="nav-right">
            <!-- Language switcher -->
            <div class="lang-switcher d-flex gap-2 me-3">
                <?php foreach ($locales as $loc): ?>
                    <?php if ($loc === $locale): ?>
                        <span class="lang-active fw-bold"><?= strtoupper(e($loc)) ?></span>
                    <?php else: ?>
                        <a href="<?= e(locale_url($loc)) ?>"><?= strtoupper(e($loc)) ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="hotline-area d-xl-flex d-none">
                <div class="icon">
                    <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.1578 21.1819C28.1081 21.1406 22.4869 17.1413 20.9691 17.3859C20.2369 17.5153 19.8188 18.015 18.9797 19.0144C18.7477 19.2926 18.5105 19.5664 18.2681 19.8356C17.7378 19.6629 17.2205 19.4523 16.7203 19.2056C14.138 17.9484 12.0516 15.862 10.7944 13.2797C10.5477 12.7795 10.3371 12.2622 10.1644 11.7319C10.44 11.4797 10.8263 11.1544 10.9913 11.0156C11.9859 10.1812 12.4847 9.76219 12.6141 9.02906C12.8794 7.51125 8.85938 1.89187 8.81813 1.84125C8.63505 1.58162 8.39662 1.36587 8.12003 1.20958C7.84345 1.05329 7.53561 0.960361 7.21875 0.9375C5.58938 0.9375 0.9375 6.97125 0.9375 7.98844C0.9375 8.0475 1.02281 14.0512 8.42625 21.5822C15.9488 28.9772 21.9525 29.0625 22.0116 29.0625C23.0278 29.0625 29.0625 24.4106 29.0625 22.7812C29.0394 22.4643 28.9463 22.1565 28.7898 21.8799C28.6334 21.6034 28.4175 21.3649 28.1578 21.1819Z"></path>
                    </svg>
                </div>
                <div class="content">
                    <span><?= e(t('footer.booking_dept')) ?></span>
                    <h6><a href="tel:+79280000011">+7 928 000 00 11</a></h6>
                </div>
            </div>
            <div class="contact-area">
                <a href="<?= url('contact') ?>" class="primary-btn1 two btn-hover d-xl-flex d-none">
                    <?= e(t('nav.book')) ?><span></span>
                </a>
            </div>
            <div class="sidebar-button mobile-menu-btn">
                <svg width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.29445 2.8421H10.5237C11.2389 2.8421 11.8182 2.2062 11.8182 1.42105C11.8182 0.635903 11.2389 0 10.5237 0H1.29445C0.579249 0 0 0.635903 0 1.42105C0 2.2062 0.579249 2.8421 1.29445 2.8421Z"></path>
                    <path d="M1.23002 10.421H18.77C19.4496 10.421 20 9.78506 20 8.99991C20 8.21476 19.4496 7.57886 18.77 7.57886H1.23002C0.550421 7.57886 0 8.21476 0 8.99991C0 9.78506 0.550421 10.421 1.23002 10.421Z"></path>
                    <path d="M18.8052 15.1579H10.2858C9.62563 15.1579 9.09094 15.7938 9.09094 16.5789C9.09094 17.3641 9.62563 18 10.2858 18H18.8052C19.4653 18 20 17.3641 20 16.5789C20 15.7938 19.4653 15.1579 18.8052 15.1579Z"></path>
                </svg>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->
