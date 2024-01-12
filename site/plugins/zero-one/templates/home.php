<?php snippet('header') ?>

<?php if($page->selectBuilder() == "page-builder"): ?>
<main role="main"<?php e($page->animation() == "true", ' uk-scrollspy="target: > section; cls: uk-animation-slide-bottom-small; delay: 300"') ?>>
<?php foreach ($page->modules()->toBlocks() as $block): ?>
<?php snippet('blocks/' . $block->type(), ['data' => $block]) ?>
<?php endforeach ?>
</main>
<?php else: ?>
<main role="main">
<?php foreach ($page->layout()->toLayouts() as $layout): ?>
<?php snippet('layout/layout', ['layout' => $layout]) ?>
<?php endforeach ?>
</main>
<?php endif ?>

<?php snippet('footer') ?>