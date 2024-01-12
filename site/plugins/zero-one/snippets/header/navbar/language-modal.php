<div id="language-modal" class="uk-modal" uk-modal> <!-- language modal -->
    <div class="uk-modal-dialog uk-margin-auto-vertical uk-text-center">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h4 class="uk-modal-title"><?= $site->labelLanguageTitle()->html() ?></h4>
        </div>
        <div class="uk-modal-body uk-margin-small">
        <?php if($kirby->languages()->isNotEmpty()): ?>
        <ul id="language" class="uk-subnav uk-flex-center" aria-live="polite" uk-margin>
            <?php foreach($kirby->languages() as $language): ?>
            <li<?php e($kirby->language() == $language, ' class="uk-active"') ?>>
            <a href="<?= $page->url($language->code()) ?>" hreflang="<?= $language->code() ?>">
            <?= $language->name() ?>
            </a>
            </li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
        </div>
        <div class="uk-modal-footer"><?= $site->labelLanguageFooter()->html() ?></div>
    </div>
</div>