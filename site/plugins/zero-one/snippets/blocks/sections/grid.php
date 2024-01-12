<?php if($data->sectionColor() == "image"): ?>
<?php if($img = $data->backgroundImage()->toFile()): ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?php e($data->shapeDividertoggle()->isTrue(), ' uk-position-relative') ?><?= $data->sectionSize() ?><?= $data->backgroundImagePosition() ?><?= $data->backgroundImageSize() ?><?= $data->sectionTextColor() ?><?= $data->sectionRemovePadding() ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-color: <?= $data->backgroundOverlayColor() ?>; background-blend-mode: overlay; background-repeat:<?= $data->backgroundImageRepeat() ?>"<?php e($data->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -200"') ?><?php e($data->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img="loading: eager">
<?php else: ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?php e($data->shapeDividertoggle()->isTrue(), ' uk-position-relative') ?><?= $data->sectionSize() ?><?= $data->sectionRemovePadding() ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>" style="background-color: <?= $data->backgroundOverlayColor() ?>; background-blend-mode: overlay;">
<?php endif ?>
<?php else: ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?php e($data->shapeDividertoggle()->isTrue(), ' uk-position-relative') ?><?= $data->sectionSize() ?><?= $data->sectionColor() ?><?= $data->sectionRemovePadding() ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<?php endif ?>
<?php if($data->shapeDividertoggle()->isTrue() && ($data->shapeDividerposition() == 'top' or $data->shapeDividerposition() == 'both')): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $data->shapeDivider()->value() ?>" data-position="top" style="top:-1px;<?php e($data->shapeDividerheight()->isNotEmpty(), ' height:' . $data->shapeDividerheight() . ';', 'height:150px;') ?>">
    <?php snippet('layout/shape-divider', ['layout' => $data]) ?>
</div>
<?php endif ?>
<div class="uk-container<?= $data->gridWidth() ?>"<?php if($data->shapeDividertoggle()->isTrue()): ?> style="<?php if($data->shapeDividerposition() == "top" or $data->shapeDividerposition() == "both"): ?>margin-top:<?= $data->shapeDividerheight()->or('150px') ?>;<?php endif ?><?php if($data->shapeDividerposition() != "top"): ?>margin-bottom:<?= $data->shapeDividerheight()->or('150px') ?>;<?php endif ?>"<?php endif ?>>
<div class="uk-grid<?= $data->columnsVerticalAlign() ?><?= $data->columnsHorizontalAlign() ?><?php e($data->gridHeadings() == "true", ' tm-heading') ?><?= $data->columnGap() ?><?php e($data->columnsDivider() == "true", ' uk-grid-divider') ?><?php e($data->centerText() == "true", ' uk-text-center') ?>" uk-grid<?php e($data->columnsParallax() == "true", '="parallax: 90"') ?>>
<?php 
// using the `toStructure()` method, we create a structure collection
$items = $data->columns()->toStructure();
// we can then loop through the entries and render the individual fields
foreach ($items as $item): ?>
<div class="<?php e($item->columnWidth() != "uk-width-1-1" && $data->columnStack() == "mobile", 'uk-width-1-2@s ') ?><?= $item->columnWidth() ?><?php if($item->columnClass()->isNotEmpty()): ?> <?= $item->columnClass()->value() ?><?php endif ?>">
<?php if($item->columnCard() == "true"): ?><div class="uk-card<?= $item->columnCardSize() ?><?= $item->columnCardColor() ?><?php e($item->columnCardHover() == "true", ' uk-card-hover') ?> uk-card-body"><?php endif ?>
<?php if($item->columnContentHTML() == "editor"): ?>
<?= $item->columnEditor()->toBlocks() ?>
<?php elseif($item->columnContentHTML() == "html"): ?>
<?= $item->columnHTML()->value() ?>
<?php elseif($item->columnContentHTML() == "subgrid"): ?>
<div class="uk-grid<?= $data->columnGap() ?><?php e($data->columnsDivider() == "true", ' uk-grid-divider') ?>" uk-grid>
<?php 
// using the `toStructure()` method, we create a structure collection
$subitems = $item->subColumns()->toStructure();
// we can then loop through the entries and render the individual fields
foreach ($subitems as $subitem): ?>
<div class="<?php e($subitem->subColumnWidth() != "uk-width-1-1" && $data->columnStack() == "mobile", 'uk-width-1-2@s ') ?><?= $subitem->subColumnWidth() ?><?php if($subitem->subColumnClass()->isNotEmpty()): ?> <?= $subitem->subColumnClass()->value() ?><?php endif ?>">
<?php if($subitem->subColumnCard() == "true"): ?><div class="uk-card<?= $subitem->subColumnCardSize() ?><?= $subitem->subColumnCardColor() ?><?php e($subitem->subColumnCardHover() == "true", ' uk-card-hover') ?> uk-card-body"><?php endif ?>
<?php if($subitem->subColumnContentHTML() == "editor"): ?><?= $subitem->subColumnEditor()->toBlocks() ?><?php elseif($subitem->subColumnContentHTML() == "html"): ?><?= $subitem->subColumnHTML()->value() ?><?php else: ?><?= $subitem->subColumnContent()->kt() ?><?php endif ?>
<?php if($subitem->subColumnCard() == "true"): ?></div><?php endif ?>
</div>
<?php endforeach ?>
</div>
<?php else: ?>
<?= $item->columnContent()->kt() ?>
<?php endif ?>
<?php if($item->columnCard() == "true"): ?></div><?php endif ?>
</div>
<?php endforeach ?>
</div>
</div>
<?php if($data->shapeDividertoggle()->isTrue() && $data->shapeDividerposition() != 'top'): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $data->shapeDivider()->value() ?>" data-position="bottom" style="bottom:-1px;<?php e($data->shapeDividerheight()->isNotEmpty(), ' height:' . $data->shapeDividerheight() . ';', 'height:150px;') ?>">
    <?php snippet('layout/shape-divider', ['layout' => $data]) ?>
</div>
<?php endif ?>
</section>
