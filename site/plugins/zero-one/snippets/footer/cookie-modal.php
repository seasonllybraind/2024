<div id="cookieModal" class="uk-flex-top" uk-modal="bg-close: false; esc-close: false">
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <?= $site->cookieConsenttext()->kt()->or('<p>This website uses cookies or similar technologies, to enhance your browsing experience and provide personalized recommendations. By continuing to use our website, you agree to our Privacy Policy.</p>') ?>
        <button id="acceptCookie" class="uk-button uk-button-primary" type="button"><?= $site->cookieConsentbutton()->or('I understand and accept') ?></button>
    </div>
</div>