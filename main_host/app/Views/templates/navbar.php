<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="<?= base_url('public/assets/img/shortener.png') ?>" width="32">
            <span class="fs-4 font-nunito-sans">&emsp;AkuOnline </span>
        </a>

        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto font-nunito-sans">
            <a class="me-3 py-2 text-dark text-decoration-none <?= $current_nav == 'shortener' ? ' border-bottom border-danger border-3' : '' ?>" href="<?= base_url() ?>">URL Shortener</a>
            <a class="me-3 py-2 text-dark text-decoration-none <?= $current_nav == 'qr' ? ' border-bottom border-danger border-3' : '' ?>" href="<?= base_url('qr') ?>">QR Generator</a>
            <a class="py-2 text-dark text-decoration-none" href="#">Link Tree</a>
        </nav>
    </div>
</header>