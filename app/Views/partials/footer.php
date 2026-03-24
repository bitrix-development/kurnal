<?php
/**
 * Footer partial
 * @var string $locale
 */
$locale = $locale ?? 'ru';
?>
<!-- Footer Start -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo-area">
                        <div class="footer-logo-and-title">
                            <img class="footer-logo" src="<?= asset('img/footer-logo-1.svg') ?>" alt="">
                            <div class="section-title">
                                <p><?= e(t('footer.newsletter')) ?></p>
                            </div>
                        </div>
                        <div class="newsletter-area">
                            <h2><?= e(t('footer.newsletter')) ?></h2>
                            <form class="newsletter-form">
                                <input type="email" placeholder="Email Address">
                                <button type="submit">
                                    <svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.5 13.0001C6.5 12.7846 6.5856 12.5779 6.73798 12.4255C6.89035 12.2732 7.09701 12.1876 7.3125 12.1876H16.7261L13.2372 8.7003C13.0847 8.54773 12.999 8.34081 12.999 8.12505C12.999 7.90929 13.0847 7.70237 13.2372 7.5498C13.3898 7.39723 13.5967 7.31152 13.8125 7.31152C14.0283 7.31152 14.2352 7.39723 14.3878 7.5498L19.2628 12.4248C19.3384 12.5003 19.3984 12.5899 19.4394 12.6886C19.4804 12.7874 19.5015 12.8932 19.5015 13.0001C19.5015 13.1069 19.4804 13.2127 19.4394 13.3115C19.3984 13.4102 19.3384 13.4998 19.2628 13.5753L14.3878 18.4503C14.2352 18.6029 14.0283 18.6886 13.8125 18.6886C13.5967 18.6886 13.3898 18.6029 13.2372 18.4503C13.0847 18.2977 12.999 18.0908 12.999 17.8751C12.999 17.6593 13.0847 17.4524 13.2372 17.2998L16.7261 13.8126H7.3125C7.09701 13.8126 6.89035 13.7269 6.73798 13.5746C6.5856 13.4222 6.5 13.2155 6.5 13.0001Z"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-6 d-flex justify-content-sm-center">
                    <div class="contact-wrapper">
                        <div class="contact-area">
                            <div class="widget-title"><h5><?= e(t('footer.booking_dept')) ?></h5></div>
                            <div class="icon-and-contact">
                                <div class="icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.0175 11.297C14.991 11.275 11.9965 9.132 11.184 9.2725C10.7935 9.3415 10.57 9.6075 10.1225 10.141C10.0505 10.227 9.877 10.4325 9.743 10.579C9.46016 10.4869 9.18429 10.3746 8.9175 10.243C7.54026 9.5725 6.4275 8.45974 5.757 7.0825C5.62543 6.81571 5.51315 6.53984 5.421 6.257C5.568 6.1225 5.774 5.949 5.862 5.875C6.3925 5.43 6.6585 5.2065 6.7275 4.8155C6.869 4.006 4.725 1.009 4.703 0.982C4.60536 0.843528 4.4782 0.728462 4.33069 0.645108C4.18317 0.561755 4.01899 0.512193 3.85 0.5C2.981 0.5 0.5 3.718 0.5 4.2605C0.5 4.292 0.5455 7.494 4.494 11.5105C8.506 15.4545 11.708 15.5 11.7395 15.5C12.282 15.5 15.5 13.019 15.5 12.15C15.4878 11.9809 15.4382 11.8167 15.3548 11.6692C15.2713 11.5217 15.1561 11.3945 15.0175 11.297Z"></path>
                                    </svg>
                                </div>
                                <div class="contact">
                                    <ul>
                                        <li><a href="tel:+79280000011">+7 928 000 00 11</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="social-area">
                            <h5><?= e(t('footer.social')) ?></h5>
                            <ul class="social-list">
                                <li class="single-social"><a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a></li>
                                <li class="single-social"><a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a></li>
                                <li class="single-social"><a href="https://vk.com/"><i class="bi bi-telegram"></i></a></li>
                                <li class="single-social"><a href="https://www.youtube.com/"><i class="bi bi-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-6">
                    <div class="location-and-payment">
                        <div class="title-and-location-area">
                            <div class="widget-title"><h5><?= e(t('footer.contacts')) ?></h5></div>
                            <ul>
                                <li><div class="icon"><svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M8 0C4.89838 0 2.375 2.52338 2.375 5.625C2.375 6.67294 2.66528 7.69563 3.21466 8.58288L7.67981 15.7784C7.76534 15.9163 7.91603 16 8.07809 16C8.07934 16 8.08056 16 8.08181 16C8.24528 15.9987 8.39628 15.9124 8.48025 15.7721L12.8316 8.50688C13.3507 7.63838 13.625 6.64184 13.625 5.625C13.625 2.52338 11.1016 0 8 0Z"></path></svg></div></li>
                                <li>
                                    <a class="location" href="#">г. Нальчик, ул. Шогенцукова, 5а</a>
                                    <div class="content"><a class="get-direction" href="https://yandex.ru/maps/"><?= e(t('footer.direction')) ?></a></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-menu">
        <div class="container">
            <div class="footer-menu-wrap">
                <ul class="footer-menu-list">
                    <li class="menu-list"><a href="<?= url('rooms') ?>"><?= e(t('nav.rooms')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('services') ?>"><?= e(t('nav.services')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('about') ?>"><?= e(t('nav.about')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('blog') ?>"><?= e(t('nav.blog')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('privacy-policy') ?>"><?= e(t('nav.privacy')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('agreement') ?>"><?= e(t('nav.agreement')) ?></a></li>
                </ul>
                <ul class="footer-menu-list">
                    <li class="menu-list"><a href="<?= url('news') ?>"><?= e(t('nav.news')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('auctions') ?>"><?= e(t('nav.auctions')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('documents') ?>"><?= e(t('nav.documents')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('director') ?>"><?= e(t('nav.director')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('reviews') ?>"><?= e(t('nav.reviews')) ?></a></li>
                    <li class="menu-list"><a href="<?= url('sanatoriums') ?>"><?= e(t('nav.sanatoriums')) ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-bottom">
            <p><?= e(t('footer.copyright')) ?> | <a href="<?= url() ?>">ОАО Курорт Нальчик</a></p>
        </div>
    </div>
</footer>
<!-- Footer End -->
