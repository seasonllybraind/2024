<?php if($data->heroStyle() == "image"): ?>
<?php if($img = $data->heroCover()->toFile()): ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?php e($data->shapeDividertoggle()->isTrue(), ' uk-position-relative') ?><?php e($data->heroSize() == "medium", ' uk-section-medium') ?><?php e($data->heroSize() == "large", ' uk-section-large') ?><?php e($data->heroSize() == "xlarge", ' uk-section-xlarge') ?><?= $data->backgroundImagePosition() ?><?= $data->backgroundImageSize() ?><?= $data->sectionTextColor() ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-color: <?= $data->backgroundOverlayColor() ?>; background-blend-mode: overlay; background-repeat:<?= $data->backgroundImageRepeat() ?>"<?php e($data->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -200;"') ?><?php e($data->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img="loading: eager">
<?php else: ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?php e($data->shapeDividertoggle()->isTrue(), ' uk-position-relative') ?><?php e($data->heroSize() == "medium", ' uk-section-medium') ?><?php e($data->heroSize() == "large", ' uk-section-large') ?><?php e($data->heroSize() == "xlarge", ' uk-section-xlarge') ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<?php endif ?>
<?php elseif($data->heroStyle() == "video"): ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section uk-cover-container uk-light<?php e($data->shapeDividertoggle()->isTrue(), ' uk-position-relative') ?><?php e($data->heroSize() == "medium", ' uk-section-medium') ?><?php e($data->heroSize() == "large", ' uk-section-large') ?><?php e($data->heroSize() == "xlarge", ' uk-section-xlarge') ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<?php if($data->mediaVideoSource() == "upload"): ?>
<?php if($video = $data->mediaVideo()->toFile()): ?>
<video src="<?= $video->url() ?>" style="z-index:-1;" autoplay loop muted playsinline uk-cover></video>
<?php endif ?>
<?php else: ?>
<iframe src="<?= $data->mediaVideoUrl() ?>" style="z-index:-1;" width="1920" height="1080" frameborder="0" allowfullscreen uk-cover></iframe>
<?php endif ?>
<div class="uk-overlay-gradient uk-position-cover" style="z-index:-1;"></div>
<?php else: ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?php e($data->shapeDividertoggle()->isTrue(), ' uk-position-relative') ?><?php e($data->heroStyle() == "muted", ' uk-section-muted') ?><?php e($data->heroStyle() == "primary", ' uk-section-primary') ?><?php e($data->heroStyle() == "secondary", ' uk-section-secondary') ?><?php e($data->heroSize() == "medium", ' uk-section-medium') ?><?php e($data->heroSize() == "large", ' uk-section-large') ?><?php e($data->heroSize() == "xlarge", ' uk-section-xlarge') ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<?php endif ?>
<?php if($data->shapeDividertoggle()->isTrue() && ($data->shapeDividerposition() == 'top' or $data->shapeDividerposition() == 'both')): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $data->shapeDivider()->value() ?>" data-position="top" style="top:-1px;<?php e($data->shapeDividerheight()->isNotEmpty(), ' height:' . $data->shapeDividerheight() . ';', 'height:150px;') ?>">
    <?php snippet('layout/shape-divider', ['layout' => $data]) ?>
</div>
<?php endif ?>
<div class="uk-container uk-padding<?php e($data->heroTextWidth() == "small", ' uk-container-small') ?><?php e($data->heroTextAlign() == "center", ' uk-flex uk-flex-center') ?><?php e($data->heroTextAlign() == "right", ' uk-flex uk-flex-right') ?>"<?php if($data->shapeDividertoggle()->isTrue()): ?> style="<?php if($data->shapeDividerposition() == "top" or $data->shapeDividerposition() == "both"): ?>margin-top:<?= $data->shapeDividerheight()->or('150px') ?>;<?php endif ?><?php if($data->shapeDividerposition() != "top"): ?>margin-bottom:<?= $data->shapeDividerheight()->or('150px') ?>;<?php endif ?>"<?php endif ?>>
<?php if($data->heroCard() == "true"): ?><div class="uk-card uk-card-large<?= $data->heroCardColor() ?><?php e($data->heroCardHover() == "true", ' uk-card-hover') ?> uk-card-body"><?php endif ?>
<div class="<?php e($data->heroHeadings() == "true", ' tm-heading') ?><?php e($data->heroTextAlign() == "center", ' uk-text-center', ' uk-width-2-3@s') ?><?php e($data->heroTextAlign() == "right", ' uk-text-right', ' uk-width-2-3@s') ?>">
<?php if($data->heroContentOption() == "editor"): ?>
<?= $data->contentBlocks()->toBlocks() ?>
<?php elseif($data->heroContentOption() == "html"): ?>
<?= $data->heroHTML()->value() ?>
<?php else: ?>
<?= $data->heroText()->kt() ?>
<?php endif ?>
</div>
<?php if($data->heroCard() == "true"): ?></div><?php endif ?>
</div>
<?php if($data->shapeDividertoggle()->isTrue() && $data->shapeDividerposition() != 'top'): ?>
<div class="tm-shape-divider-wrap" data-style="<?= $data->shapeDivider()->value() ?>" data-position="bottom" style="bottom:-1px;<?php e($data->shapeDividerheight()->isNotEmpty(), ' height:' . $data->shapeDividerheight() . ';', 'height:150px;') ?>">
    <?php snippet('layout/shape-divider', ['layout' => $data]) ?>
</div>
<?php endif ?>
</section>