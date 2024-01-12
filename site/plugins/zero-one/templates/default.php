<?php snippet('header') ?>

<?php if($page->headersection() == "false"): ?><?php else: ?>
<?php snippet('page/heading') ?>
<?php endif ?>
<div class="uk-container<?php e($page->pageWidth() == "xsmall", ' uk-container-xsmall') ?><?php e($page->pageWidth() == "small", ' uk-container-small') ?><?php e($page->headerBackgroundtoggle()->isTrue() or $site->headerImage()->isTrue(), ' uk-margin-large', ' uk-margin-large-bottom') ?>">
<div uk-grid>

<main class="uk-width-expand uk-margin-bottom uk-animation-slide-bottom-small" role="main">
<?= $page->text()->toBlocks() ?>
</main>

<?php if($page->enableSidebar() == "true"): ?>
<aside class="uk-width-1-3@s uk-animation-slide-right-small uk-margin-large-bottom">
<?= $page->sidebarText()->toBlocks() ?>
</aside>
<?php endif ?>

</div>
</div>

<?php snippet('footer') ?>