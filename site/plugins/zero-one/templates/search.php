<?php snippet('header') ?>

<main role="main">
<header class="uk-section uk-section-small">
<div class="uk-container uk-text-center uk-animation-slide-bottom-small">
	<h1 class="<?php e($site->pageTitleSize() == "medium", 'uk-heading-medium') ?><?php e($site->pageTitleSize() == "large", 'uk-heading-large') ?><?php e($site->pageTitleSize() == "xlarge", 'uk-heading-xlarge') ?><?php e($site->pageTitleColor() == "muted", ' uk-text-muted') ?><?php e($site->pageTitleColor() == "primary", ' uk-text-primary') ?>" uk-parallax="opacity: 1,0.3; y: 0,-30; scale: 0.9,1; start: 20%; end: 20%;"><?=$page->altTitle()->isEmpty() ? $page->title() : $page->altTitle() ?></h1>
	<hr class="uk-divider-small" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
<div class="uk-text-lead" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
<?php if($query): ?>
  <p><?= $site->labelSearchNote()->html() ?> "<?= html($query) ?>"</p>
<?php else: ?>
<?= $page->intro()->kt() ?>
<?php endif ?>
</div>
</div>
</header>

<div class="uk-container uk-container-xsmall">
<div class="uk-flex uk-flex-center">
<form class="uk-search uk-search-large">
  <a href="" class="uk-search-icon-flip" uk-search-icon></a>
  <input class="uk-search-input" type="search" name="q" placeholder="<?= $site->labelSearchPlaceholder()->html() ?>" value="<?= html($query) ?>">
</form>
</div>
<div class="uk-padding uk-text-center">
<?php if($results->count() > 0): ?>
<ul class="uk-list">
  <?php foreach ($results as $result): ?>
  <li>
    <a href="<?= $result->url() ?>">
      <h3><?= $result->title() ?></h3>
    </a>
  </li>
  <?php endforeach ?>
</ul>
<?php snippet('blog/pagination') ?>
<?php else: ?>
  <?php if($query): ?>
  <p class="uk-text-center"><?= $site->labelSearchNoResults()->html() ?></p>
  <?php endif ?>
<?php endif ?>
</div>
</div>
</main>

<?php snippet('footer') ?>