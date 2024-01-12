<?php if($page->headerBackgroundtoggle()->isTrue()): ?>
<?php if($img = $page->header()->toFile()): ?>
<header class="uk-section uk-section-overlap uk-animation-slide-bottom-small<?php if($site->pageHeaderSize()): ?> <?= $site->pageHeaderSize() ?><?php endif ?><?php if($page->headerImagePosition()): ?> <?= $page->headerImagePosition() ?><?php endif ?><?php if($page->headerImageSize()): ?> <?= $page->headerImageSize() ?><?php endif ?><?php if($page->headerTextColor()): ?> <?= $page->headerTextColor() ?><?php endif ?>" sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]" data-src="<?= $img->url() ?>" style="background-color: <?= $page->headerOverlayColor() ?>; background-blend-mode: overlay; background-repeat:<?= $page->headerImageRepeat() ?>"<?php e($page->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -120;"') ?><?php e($page->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img="loading: eager">
<?php else: ?>
<header class="uk-section uk-section-overlap uk-animation-slide-bottom-small<?php if($site->pageHeaderSize()): ?> <?= $site->pageHeaderSize() ?><?php endif ?><?php if($page->headerTextColor()): ?> <?= $page->headerTextColor() ?><?php endif ?>" style="background-color: <?= $page->headerOverlayColor() ?>; background-blend-mode: overlay;">
<?php endif ?>
<?php elseif($site->headerImage()->isTrue()): ?>
<?php if($img = $site->header()->toFile()): ?>
<header class="uk-section uk-animation-slide-bottom-small<?php if($site->pageHeaderSize()): ?> <?= $site->pageHeaderSize() ?><?php endif ?><?php if($site->headerImagePosition()): ?> <?= $site->headerImagePosition() ?><?php endif ?><?php if($site->headerImageSize()): ?> <?= $site->headerImageSize() ?><?php endif ?><?php if($site->headerTextColor()): ?> <?= $site->headerTextColor() ?><?php endif ?>" sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]" data-src="<?= $img->url() ?>" style="background-color: <?= $site->headerOverlayColor() ?>; background-blend-mode: overlay; background-repeat:<?= $site->headerImageRepeat() ?>"<?php e($site->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -120"') ?><?php e($site->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img="loading: eager">
<?php else: ?>
<header class="uk-section uk-animation-slide-bottom-small<?php if($site->pageHeaderSize()): ?> <?= $site->pageHeaderSize() ?><?php endif ?><?php if($site->headerTextColor()): ?> <?= $site->headerTextColor() ?><?php endif ?>" style="background-color: <?= $site->headerOverlayColor() ?>; background-blend-mode: overlay;">
<?php endif ?>
<?php else: ?>
<header class="uk-section uk-animation-slide-bottom-small<?php if($site->pageHeaderSize()): ?> <?= $site->pageHeaderSize() ?><?php endif ?> uk-section-default">
<?php endif ?>

<?php if(($page->headerBackgroundtoggle()->isTrue() && $page->shapeDividertoggle()->isTrue()) or ($site->headerImage()->isTrue() && $site->shapeDividertoggle()->isTrue())): ?>
<?php if($page->headerBackgroundtoggle()->isTrue() && $page->shapeDividertoggle()->isTrue()): ?>
<?php if($page->shapeDividerposition() == 'top' or $page->shapeDividerposition() == 'both'): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $page->shapeDivider()->value() ?>" data-position="top" style="top:-1px;<?php e($page->shapeDividerheight()->isNotEmpty(), ' height:' . $page->shapeDividerheight() . ';', 'height:150px;') ?>">
	<?php snippet('layout/shape-divider', ['layout' => $page]) ?>
</div>
<?php endif ?>
<?php elseif($site->headerImage()->isTrue() && $site->shapeDividertoggle()->isTrue() && !$page->headerBackgroundtoggle()->isTrue()): ?>
<?php if($site->shapeDividerposition() == 'top' or $site->shapeDividerposition() == 'both'): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $site->shapeDivider()->value() ?>" data-position="top" style="top:-1px;<?php e($site->shapeDividerheight()->isNotEmpty(), ' height:' . $site->shapeDividerheight() . ';', 'height:150px;') ?>">
	<?php snippet('layout/shape-divider', ['layout' => $site]) ?>
</div>
<?php endif ?>
<?php endif ?>
<?php endif ?>

<div class="uk-container<?php e($site->headerAlign() == "center", ' uk-text-center uk-container-xsmall') ?><?php e($site->headerAlign() == "left" && $site->headerWidth() == "large", ' uk-container-xlarge') ?><?php e($site->headerAlign() == "left" && $site->headerWidth() == "expand", ' uk-container-expand') ?><?php if($page->transparentNavbar()->isEmpty()): ?><?php e($site->transparentNavbar() == "true", ' tm-transparent-navbar-positive') ?><?php elseif($page->transparentNavbar() == "transparent"): ?>  tm-transparent-navbar-positive<?php endif ?>"<?php if(($page->headerBackgroundtoggle()->isTrue() && $page->shapeDividertoggle()->isTrue()) or ($site->headerImage()->isTrue() && $site->shapeDividertoggle()->isTrue() && !$page->headerBackgroundtoggle()->isTrue())): ?><?php $layout = $page->headerBackgroundtoggle()->isTrue() && $page->shapeDividertoggle()->isTrue() ? $page : $site ?> style="<?php if($layout->shapeDividerposition() == "top" or $layout->shapeDividerposition() == "both"): ?>margin-top:<?= $layout->shapeDividerheight()->or('150px') ?>;<?php endif ?><?php if($layout->shapeDividerposition() != "top"): ?>margin-bottom:<?= $layout->shapeDividerheight()->or('150px') ?>;<?php endif ?>"<?php endif ?>>

<?php if ($page->template() == "blog"): ?>
	<?php if($category OR $tag OR $year): ?>
	<?php snippet('blog/filtered') ?>
	<?php else: ?>
	<h1 class="<?php e($site->pageTitleSize() == "medium", 'uk-heading-medium') ?><?php e($site->pageTitleSize() == "large", 'uk-heading-large') ?><?php e($site->pageTitleSize() == "xlarge", 'uk-heading-xlarge') ?><?php e($site->pageTitleColor() == "muted", ' uk-text-muted') ?><?php e($site->pageTitleColor() == "primary", ' uk-text-primary') ?>" uk-parallax="opacity: 1,0.3; start: 20%; end: 20%;<?php e($site->headerAlign() == "center", ' y: 0,-30; scale: 0.9,1;') ?>"><?=$page->altTitle()->isEmpty() ? $page->title() : $page->altTitle() ?></h1>
	<?php if ($page->intro()->isNotEmpty()): ?>
	<hr class="uk-divider-small">
	<div class="uk-text-lead" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;"><?= $page->intro()->kt() ?></div>
	<?php endif ?>
	<?php if ($page->categories()->isNotEmpty()): ?>
	<div class="uk-flex<?php e($site->headerAlign() == "center", ' uk-flex-center') ?>" uk-parallax="opacity: 1,0.2; start: 20%; end: 20%;">
	<?php snippet('blog/categories') ?>
	</div>
	<?php endif ?>
	<?php endif ?>

<?php elseif($page->template() == "shop"): ?>
	<?php if($category OR $tag): ?>
	<?php snippet('shop/filtered') ?>
	<?php else: ?>
	<h1 class="<?php e($site->pageTitleSize() == "medium", 'uk-heading-medium') ?><?php e($site->pageTitleSize() == "large", 'uk-heading-large') ?><?php e($site->pageTitleSize() == "xlarge", 'uk-heading-xlarge') ?><?php e($site->pageTitleColor() == "muted", ' uk-text-muted') ?><?php e($site->pageTitleColor() == "primary", ' uk-text-primary') ?>" uk-parallax="opacity: 1,0.3; start: 20%; end: 20%;<?php e($site->headerAlign() == "center", ' y: 0,-30; scale: 0.9,1;') ?>"><?=$page->altTitle()->isEmpty() ? $page->title() : $page->altTitle() ?></h1>
	<?php if ($page->intro()->isNotEmpty()): ?>
	<hr class="uk-divider-small">
	<div class="uk-text-lead" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;"><?= $page->intro()->kt() ?></div>
	<?php endif ?>
	<?php if ($page->categories()->isNotEmpty()): ?>
	<div class="uk-flex<?php e($site->headerAlign() == "center", ' uk-flex-center') ?>" uk-parallax="opacity: 1,0.2; start: 20%; end: 20%;">
	<?php snippet('shop/categories') ?>
	</div>
	<?php endif ?>
	<?php endif ?>
<?php else: ?>
	<h1 class="<?php e($site->pageTitleSize() == "medium", 'uk-heading-medium') ?><?php e($site->pageTitleSize() == "large", 'uk-heading-large') ?><?php e($site->pageTitleSize() == "xlarge", 'uk-heading-xlarge') ?><?php e($site->pageTitleColor() == "muted", ' uk-text-muted') ?><?php e($site->pageTitleColor() == "primary", ' uk-text-primary') ?>" uk-parallax="opacity: 1,0.3; start: 20%; end: 20%;<?php e($site->headerAlign() == "center", ' y: 0,-30; scale: 0.9,1;') ?>"><?=$page->altTitle()->isEmpty() ? $page->title() : $page->altTitle() ?></h1>
	<?php if ($page->intro()->isNotEmpty()): ?>
	<hr class="uk-divider-small" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
	<div class="uk-text-lead" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
		<?= $page->intro()->kt() ?>
	</div>
	<?php endif ?>

	<?php if($page->template() == "work"): ?> <!-- project tags -->
	<div class="uk-flex<?php e($site->headerAlign() == "center", ' uk-flex-center') ?>" uk-parallax="opacity: 1,0.2; start: 20%; end: 20%;">
	<?php snippet('work/tags') ?>
	</div>

	<?php else: ?>
	<?php if($site->breadcrumbs() != "false"): ?>
	<!-- breadcrumb -->
	<div class="uk-flex<?php e($site->headerAlign() == "center", ' uk-flex-center') ?>" uk-parallax="opacity: 1,0.2; start: 20%; end: 20%;">
	<?php snippet('breadcrumb') ?>
	</div>
	<?php endif ?>
	<?php endif ?>

<?php endif ?> 

</div> <!-- container end -->
<?php if(($page->headerBackgroundtoggle()->isTrue() && $page->shapeDividertoggle()->isTrue()) or ($site->headerImage()->isTrue() && $site->shapeDividertoggle()->isTrue())): ?>
<?php if($page->headerBackgroundtoggle()->isTrue() && $page->shapeDividertoggle()->isTrue()): ?>
<?php if($page->shapeDividerposition() != 'top'): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $page->shapeDivider()->value() ?>" data-position="bottom" style="bottom:-1px;<?php e($page->shapeDividerheight()->isNotEmpty(), ' height:' . $page->shapeDividerheight() . ';', 'height:150px;') ?>">
	<?php snippet('layout/shape-divider', ['layout' => $page]) ?>
</div>
<?php endif ?>
<?php elseif($site->headerImage()->isTrue() && $site->shapeDividertoggle()->isTrue() && !$page->headerBackgroundtoggle()->isTrue()): ?>
<?php if($site->shapeDividerposition() != 'top'): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $site->shapeDivider()->value() ?>" data-position="bottom" style="bottom:-1px;<?php e($site->shapeDividerheight()->isNotEmpty(), ' height:' . $site->shapeDividerheight() . ';', 'height:150px;') ?>">
	<?php snippet('layout/shape-divider', ['layout' => $site]) ?>
</div>
<?php endif ?>
<?php endif ?>
<?php endif ?>
</header>
