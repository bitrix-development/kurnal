<?php $locale = $locale ?? 'ru'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="breadcrumb-section mb-130"><div class="container"><ul class="breadcrumb-list">
    <li><a href="<?= url() ?>"><?= e(t('common.breadcrumb.home')) ?></a></li>
    <li><span><?= e(t('nav.contact')) ?></span></li>
</ul></div></div>
<section class="contact-section mb-130"><div class="container">
    <div class="row"><div class="col-lg-8 mx-auto">
        <h1 class="mb-40"><?= e(t('contact.title')) ?></h1>
        <form id="contactForm">
            <div class="mb-3">
                <label class="form-label"><?= e(t('contact.name')) ?></label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><?= e(t('contact.email')) ?></label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><?= e(t('contact.phone')) ?></label>
                <input type="tel" class="form-control" name="phone">
            </div>
            <div class="mb-3">
                <label class="form-label"><?= e(t('contact.message')) ?></label>
                <textarea class="form-control" name="message" rows="6" required></textarea>
            </div>
            <div class="alert alert-success d-none" id="formSuccess"><?= e(t('contact.success')) ?></div>
            <button type="submit" class="primary-btn1 btn-hover"><?= e(t('contact.send')) ?><span></span></button>
        </form>
    </div></div>
</div></section>
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    fetch('<?= url('contact/send') ?>', {method:'POST', body: new FormData(this)})
        .then(r=>r.json()).then(d=>{
            if(d.success) {
                document.getElementById('formSuccess').classList.remove('d-none');
                this.reset();
            }
        });
});
</script>
