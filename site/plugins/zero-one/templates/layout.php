<?php snippet('header') ?>

<?php if($page->headersection() == "true"): ?>
<?php snippet('page/heading') ?>
<?php endif ?>

<main role="main">
<?php foreach ($page->layout()->toLayouts() as $layout): ?>
<?php snippet('layout/layout', ['layout' => $layout]) ?>
<?php endforeach ?>
</main>

<?php snippet('footer') ?>
