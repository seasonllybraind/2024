<?php snippet('header') ?>

<main role="main">
<header class="uk-section uk-section-medium">
<div class="uk-container uk-text-center uk-animation-slide-bottom-small">
	<h1 class="<?php e($site->pageTitleSize() == "medium", 'uk-heading-medium') ?><?php e($site->pageTitleSize() == "large", 'uk-heading-large') ?><?php e($site->pageTitleSize() == "xlarge", 'uk-heading-xlarge') ?><?php e($site->pageTitleColor() == "muted", ' uk-text-muted') ?><?php e($site->pageTitleColor() == "primary", ' uk-text-primary') ?>" uk-parallax="opacity: 1,0.3; y: 0,-30; scale: 0.9,1; start: 20%; end: 20%;"><?=$page->altTitle()->isEmpty() ? $page->title() : $page->altTitle() ?></h1>
	<hr class="uk-divider-small" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
	<div class="uk-text-lead" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
		<?= $page->intro()->kt() ?>
	</div>
</div>
</header>
<div class="uk-container uk-container-small uk-text-center uk-margin-xlarge-bottom">
	<div>
	<?= $page->text()->toBlocks() ?>
	</div>
	<div class="uk-margin">
		<form class="uk-search uk-search-large" method="post" action="<?= page('search')->url() ?>">
		<span class="uk-search-icon-flip" uk-search-icon></span>
		<input class="uk-search-input" type="search" name="q" placeholder="<?= $site->labelSearchPlaceholder()->html() ?>">
		</form>
	</div>
</div>
</main>

<?php snippet('footer') ?>

