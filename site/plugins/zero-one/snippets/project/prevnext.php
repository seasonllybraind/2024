
<?php if ($page->hasPrevListed()): ?>
<div class="uk-width-expand@s">
<a href="<?= $page->prevListed()->url() ?>" class="uk-tile uk-tile-muted uk-display-block uk-link-toggle uk-text-center uk-padding">
    <h3 class="uk-link-heading"><?= $page->prevListed()->title()->html() ?></h3>
    <p class="uk-text-muted"><span class="uk-margin-right tm-prev-icon" uk-icon="slidenav-previous"></span> <?= $site->labelPrevProject()->html() ?></p>
</a>
</div>
<?php endif ?>

<?php if ($page->hasNextListed()): ?>
<div class="uk-width-expand@s">
<a href="<?= $page->nextListed()->url() ?>" class="uk-tile uk-tile-muted uk-display-block uk-link-toggle uk-text-center uk-padding">
    <h3 class="uk-link-heading"><?= $page->nextListed()->title()->html() ?></h3>
    <p class="uk-text-muted"><?= $site->labelNextProject()->html() ?> <span class="uk-margin-left tm-next-icon" uk-icon="slidenav-next"></span></p>
</a>
</div>
<?php endif ?>
