<ul class="uk-pagination uk-grid-match uk-flex-middle" uk-grid>
<?php if ($page->hasPrevListed()): ?>
<li class="<?= $page->hasNextListed() ? 'uk-width-1-3@s' : 'uk-width-2-3' ?>">
    <a href="<?= $page->prevListed()->url() ?>" title="<?= $page->prevListed()->title()->html() ?>">
    <div class="uk-display-block uk-text-left uk-text-large uk-padding-small"><span class="uk-margin-small-right" uk-pagination-previous></span> <?= $site->labelProductprevious()->html() ?></div>
    <span class="uk-display-block uk-padding-small uk-text-medium uk-text-left uk-visible@s"><?= $page->prevListed()->title()->html() ?></span>
    </a>
</li>
<?php endif ?>
<li class="uk-width-1-3@s uk-text-center">
    <a href="<?= $page->parent()->url() ?>" title="<?= $site->labelBacktoshop()->html() ?> <?= $page->parent()->title() ?>">
        <div class="uk-display-block uk-text-large uk-padding-small">
            <span uk-icon="icon: thumbnails; ratio: 1.2" uk-tooltip="<?= $site->labelBacktoshop()->html() ?> <?= $page->parent()->title() ?>"></span>
        </div>
    </a>
</li>
<?php if ($page->hasNextListed()): ?>
<li class="<?= $page->hasPrevListed() ? 'uk-width-1-3@s' : 'uk-width-2-3' ?>">
    <a href="<?= $page->nextListed()->url() ?>" title="<?= $page->nextListed()->title()->html() ?>">
    <div class="uk-display-block uk-text-right uk-text-large uk-padding-small"><?= $site->labelProductnext()->html() ?> <span class="uk-margin-small-left" uk-pagination-next></span></div>
    <span class="uk-display-block uk-padding-small uk-text-right uk-visible@s"><?= $page->nextListed()->title()->html() ?></span>
    </a>
</li>
<?php endif ?>
</ul>