<?php

$src        = null;
$anchor     = $block->linkType() == "anchor" ? ' data-no-swup uk-scroll' : null;

if ($block->linkType() == "internal" && $button = $block->internalPage()->toPage()) {
    $src = $button->url();
} elseif ($block->linkType() == "url") {
    $src = $block->link()->toUrl();
} elseif ($block->linkType() == "anchor") {
    $src = '#' . $block->anchor();
} elseif ($block->linkType() == "file" && $button = $block->fileLink()->toFile()) {
    $src = $button->url();
} elseif ($block->linkType() == "email") {
    $src = 'mailto:' . Str::encode($block->emailLink());
} elseif ($block->linkType() == "telephone") {
    $src = 'tel:' . Str::encode($block->phoneLink());
}

?>
<a class="uk-button<?= $block->buttonStyle() ?><?= $block->buttonSize() ?><?= $block->marginTop() ?>" href="<?= $src ?>"<?php e($block->target() == "true", ' target="_blank"') ?><?= $anchor ?>>
<?php e($block->buttonIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="icon:' . $block->buttonIcon() . '"></span>') ?><?= $block->text()->html() ?><?php e($block->buttonStyle() == " uk-button-link", '<span class="tm-button-link-line"></span>') ?>
</a>