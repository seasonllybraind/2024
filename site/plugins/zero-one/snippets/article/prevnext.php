<ul class="uk-pagination uk-grid-match" uk-grid>
<?php if ($page->hasPrevListed()): ?>
<li class="<?= $page->hasNextListed() ? 'uk-width-1-2@s' : 'uk-width-1-1' ?>">
    <a href="<?= $page->prevListed()->url() ?>" title="<?= $page->prevListed()->title()->html() ?>">
    <div class="uk-display-block uk-text-left uk-text-large uk-padding-small"><span class="uk-margin-small-right" uk-pagination-previous></span> <?= $site->labelPrev()->html() ?></div>
    <span class="uk-display-block uk-padding-small uk-text-medium uk-text-left"><?= $page->prevListed()->title()->html() ?></span>
    </a>
</li>
<?php endif ?>

<?php if ($page->hasNextListed()): ?>
<li class="<?= $page->hasPrevListed() ? 'uk-width-1-2@s' : 'uk-width-1-1' ?>">
    <a href="<?= $page->nextListed()->url() ?>" title="<?= $page->nextListed()->title()->html() ?>">
    <div class="uk-display-block uk-text-right uk-text-large uk-padding-small"><?= $site->labelNext()->html() ?> <span class="uk-margin-small-left" uk-pagination-next></span></div>
    <span class="uk-display-block uk-padding-small uk-text-right"><?= $page->nextListed()->title()->html() ?></span>
    </a>
</li>
<?php endif ?>
</ul>