<?php snippet('header') ?>

<?php if($page->headersection() == "true"): ?>
<?php snippet('page/heading') ?>
<?php endif ?>

<main role="main"<?php e($page->animation() == "true", ' uk-scrollspy="target: section; cls: uk-animation-slide-bottom-small; delay: 200"') ?>>
<?php foreach ($page->modules()->toBlocks() as $block): ?>
<?php snippet('blocks/' . $block->type(), ['data' => $block]) ?>
<?php endforeach ?>
</main>

<?php snippet('footer') ?>
