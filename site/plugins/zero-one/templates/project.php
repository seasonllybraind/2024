<?php snippet('header') ?>

<?php if($page->headerImageOption() == "true" && $img = $page->headerImage()->toFile()): ?>
<header class="uk-section uk-section-large uk-animation-slide-bottom-small uk-background-cover uk-text-center<?php if($page->headerImagePosition()): ?> <?= $page->headerImagePosition() ?><?php endif ?><?php if($page->headerImageSize()): ?> <?= $page->headerImageSize() ?><?php endif ?><?php if($page->headerTextColor()): ?> <?= $page->headerTextColor() ?><?php endif ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-color: <?= $page->headerOverlayColor() ?>; background-blend-mode: overlay; background-repeat:<?= $page->headerImageRepeat() ?>"<?php e($page->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -150;"') ?><?php e($page->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img="loading: eager">
<?php else: ?>
<header class="uk-section uk-section-default uk-animation-slide-bottom-small uk-text-center">
<?php endif ?>
<div class="uk-container uk-container-small<?php if($page->transparentNavbar()->isEmpty()): ?><?php e($site->transparentNavbar() == "true", ' tm-transparent-navbar-positive') ?><?php elseif($page->transparentNavbar() == "transparent"): ?> tm-transparent-navbar-positive<?php endif ?>">
<div class="uk-padding-small">
<h1 class="<?php e($site->pageTitleSize() == "medium", 'uk-heading-medium') ?><?php e($site->pageTitleSize() == "large", 'uk-heading-large') ?><?php e($site->pageTitleSize() == "xlarge", 'uk-heading-xlarge') ?><?php e($site->pageTitleColor() == "muted", ' uk-text-muted') ?><?php e($site->pageTitleColor() == "primary", ' uk-text-primary') ?>" uk-parallax="opacity: 1,0.3; y: 0,-30; scale: 0.9,1; start: 20%; end: 20%;"><?=$page->altTitle()->isEmpty() ? $page->title() : $page->altTitle() ?></h1>
<hr class="uk-divider-small" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
<div class="uk-text-lead" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;">
	<?= $page->intro()->kt() ?>
</div>
<div class="uk-grid uk-grid-divider uk-grid-small uk-margin-medium uk-text-muted uk-flex-center" uk-parallax="opacity: 1,0.1; start: 20%; end: 20%;" uk-grid>
<?php 
// using the `toStructure()` method, we create a structure collection
$items = $page->projectInfo()->toStructure();
// we can then loop through the entries and render the individual fields
foreach ($items as $item): ?>
<div class="uk-width-auto@m">
  <?= $item->projectColumn()->kt() ?>
</div>
<?php endforeach ?>
<?php if($page->tags()->isNotEmpty()): ?>
<div><!-- project tags -->
  <p><b><?= $page->tagsLabel() ?></b>
  <?php foreach($page->tags()->split(',') as $tag): ?>
  <span class="tm-project-tags"><a href="<?= url($lang . '/' . $page->parent()->slug(), ['params' => ['tag' => urlencode($tag)]]) ?>"><?= Str::ucfirst($tag) ?></a></span>
  <?php endforeach ?>
  </p>
</div>
<?php endif ?>
</div>
</div>
</div>
</header>
<?php if($page->selectBuilder() == "layout-builder"): ?>
<main role="main">
<?php foreach ($page->layout()->toLayouts() as $layout): ?>
<?php snippet('layout/layout', ['layout' => $layout]) ?>
<?php endforeach ?>
</main>
<?php else: ?>
<main role="main"<?php e($page->animation() == "true", ' uk-scrollspy="target: > section; cls: uk-animation-slide-bottom-small; delay: 300"') ?>>
<?php foreach ($page->modules()->toBlocks() as $block): ?>
<?php snippet('blocks/' . $block->type(), ['data' => $block]) ?>
<?php endforeach ?>
<?php endif ?>
<section class="uk-grid uk-grid-collapse" uk-grid>
  <?php snippet('project/prevnext') ?>
</section>
</main>

<?php snippet('footer') ?>