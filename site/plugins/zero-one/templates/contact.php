<?php snippet('header') ?>

<?php if($page->headersection() == "false"): ?><?php else: ?>
<?php snippet('page/heading') ?>
<?php endif ?>
<main role="main">
<section class="uk-section uk-animation-slide-bottom-small">
<div class="uk-container uk-container-xsmall">
<div class="uk-margin-medium">
<?= $page->editor()->toBlocks() ?>
</div>
<?php if($page->contactForm() == "true"): ?>
<?php snippet('contact/form') ?>
<?php endif ?>
</div>
</section>
<?php if($page->columns()->isNotEmpty()): ?>
<section class="uk-section<?php e($page->sectionSize()->isNotEmpty(), ' ' . $page->sectionSize()) ?><?php e($page->sectionColor()->isNotEmpty(), ' ' . $page->sectionColor()) ?>">
<div class="uk-container<?php e($page->gridWidth()->isNotEmpty(), ' ' . $page->gridWidth()) ?>">
<div class="uk-grid<?php e($page->columnGap()->isNotEmpty(), ' ' . $page->columnGap()) ?><?php e($page->columnsDivider() == "true", ' uk-grid-divider') ?><?php e($page->centerText() == "true", ' uk-text-center') ?>" uk-grid>
<?php $items = $page->columns()->toStructure(); foreach ($items as $item): ?>
<div class="<?php e($item->columnWidth() != "uk-width-1-1" && $page->columnStack() == "mobile", 'uk-width-1-2@s ') ?><?= $item->columnWidth() ?>">
  <?= $item->contactColumn()->kt() ?>
</div>
<?php endforeach ?>
</div>
</div>
</section>
<?php endif ?>
</main>

<?php snippet('footer') ?>

