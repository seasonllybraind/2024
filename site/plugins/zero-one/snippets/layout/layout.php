<?php
    
    $sectionID          = $layout->sectionID()->isNotEmpty() ? $layout->sectionID()->value() : $layout->id();
    $sectionClass       = $layout->sectionClass()->isNotEmpty() ? ' ' . $layout->sectionClass()->value() : null;
    $positionRelative   = $layout->shapeDividertoggle()->isTrue() ? ' uk-position-relative' : null;
    $animation          = $layout->animationSwitch()->isTrue() ? ' uk-scrollspy="cls:' . $layout->animationType()->or('uk-animation-fade') . '; delay:' . $layout->animationDelay()->or('200')->toInt() . '"' : null;
    $hidden             = $layout->hidden()->isNotEmpty() ? ' ' . $layout->hidden() : null;
    $visible            = $layout->visible()->isNotEmpty() ? ' ' . $layout->visible() : null;
    
?>
<?php if($layout->sectionToggle()->isTrue()): ?>
<?php if($layout->sectionColor() == "custom"): ?>
<section id="<?= $sectionID ?>" class="uk-section uk-cover-container<?= $layout->sectionSize() ?><?= $layout->sectionTextColor() ?><?= $positionRelative ?><?= $layout->sectionRemovePadding() ?><?= $sectionClass ?><?= $hidden ?><?= $visible ?>"<?= $animation ?>> 
<?php if($layout->backgroundStyle() == "image"): ?>
<?php if($img = $layout->backgroundImage()->toFile()): ?>
<div class="uk-position-cover<?= $layout->backgroundImagePosition() ?><?= $layout->backgroundImageSize() ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-blend-mode: overlay; background-repeat:<?= $layout->backgroundImageRepeat() ?>"<?php e($layout->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -200"') ?><?php e($layout->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img="loading: eager"></div>
<?php endif ?>
<?php elseif($layout->backgroundStyle() == "video"): ?>
<?php if($layout->mediaVideoSource() == "upload"): ?>
<?php if($video = $layout->mediaVideo()->toFile()): ?>
<video src="<?= $video->url() ?>" autoplay loop muted playsinline uk-cover></video>
<?php endif ?>
<?php elseif($layout->mediaVideoUrl()->isNotEmpty()): ?>
<iframe src="<?= $layout->mediaVideoUrl() ?>" width="1920" height="1080" frameborder="0" allowfullscreen uk-cover></iframe>
<?php endif ?>  
<?php endif ?>
<div class="uk-position-cover" style="<?php if($layout->backgroundGradientOverlay()->isTrue()): ?>background-image: linear-gradient(<?php e($layout->backgroundGradientTransition()->isNotEmpty(), $layout->backgroundGradientTransition() . ', ') ?><?= $layout->backgroundOverlayColor() ?>, <?= $layout->backgroundOverlayColor2() ?>)<?php else: ?>background-color: <?= $layout->backgroundOverlayColor() ?><?php endif ?>; background-blend-mode: overlay;"></div>
<?php else: ?>
<section id="<?= $sectionID ?>" class="uk-section<?= $layout->sectionSize() ?><?= $positionRelative ?><?= $layout->sectionColor() ?><?= $layout->sectionRemovePadding() ?><?= $sectionClass ?><?php e($layout->preserveColor()->isTrue(), ' uk-preserve-color') ?><?= $hidden ?><?= $visible ?>"<?= $animation ?>>
<?php endif ?>

<?php else: ?>
<section id="<?= $sectionID ?>" class="<?= $sectionClass ?><?= $hidden ?><?= $visible ?>"<?= $animation ?>>
<?php endif ?>
    <?php if($layout->shapeDividertoggle()->isTrue() && ($layout->shapeDividerposition() == 'top' or $layout->shapeDividerposition() == 'both')): ?>
    <div class="tm-shape-divider-wrap" data-style="<?= $layout->shapeDivider()->value() ?>" data-position="top" style="top:-1px;<?php e($layout->shapeDividerheight()->isNotEmpty(), ' height:' . $layout->shapeDividerheight() . ';', 'height:150px;') ?>">
        <?php snippet('layout/shape-divider', ['layout' => $layout]) ?>
    </div>
    <?php endif ?>
    <div<?php if($layout->gridWidth()->isNotEmpty()): ?> class="<?= $layout->gridWidth() ?><?= $layout->containerExpand() ?>"<?php endif ?><?php if($layout->shapeDividertoggle()->isTrue()): ?> style="<?php if($layout->shapeDividerposition() == "top" or $layout->shapeDividerposition() == "both"): ?>margin-top:<?= $layout->shapeDividerheight()->or('150px') ?>;<?php endif ?><?php if($layout->shapeDividerposition() != "top"): ?>margin-bottom:<?= $layout->shapeDividerheight()->or('150px') ?>;<?php endif ?>"<?php endif ?>>
        <div class="uk-grid<?= $layout->columnsVerticalAlign() ?><?= $layout->columnsHorizontalAlign() ?><?= $layout->columnGap() ?><?php e($layout->columnsDivider() == "true", ' uk-grid-divider') ?><?php e($layout->sectionToggle()->isTrue() && $layout->sectionColor() == "custom", ' uk-position-relative') ?>" uk-grid<?php if($layout->gridMasonry()->isTrue() or $layout->gridParallax()->isTrue()): ?>="<?php e($layout->gridMasonry()->isTrue(), 'masonry: true;') ?><?php e($layout->gridParallax()->isTrue(), 'parallax: 150;') ?>"<?php endif ?>>
        <?php foreach ($layout->columns() as $column): 

        $columnOptionsExists    = $column->hasBlockType('z-column');
        $columnOptions          = $column->blocks()->filter('type', 'z-column')->first();
        $columnCard             = $columnOptionsExists && $columnOptions->columnStyle() == 'card' ? ' uk-card uk-card-body' : null;
        $columnCardSize         = $columnOptionsExists && $columnOptions->columnStyle() == 'card' ? $columnOptions->columnCardSize() : null;
        $columnCardHover        = $columnOptionsExists && $columnOptions->columnStyle() == 'card' && $columnOptions->columnCardHover()->isTrue() ? ' uk-card-hover' : null;
        $columnCardColor        = $columnOptionsExists && $columnOptions->columnStyle() == 'card' ? $columnOptions->columnCardColor() : null;
        $columnWidth            = $columnOptionsExists && $columnOptions->columnWidth()->isNotEmpty() ? $columnOptions->columnWidth() : 'uk-width-' . str_replace('/', '-', $column->width()) . '@m';
        $tabletWidth            = $columnOptionsExists && $columnOptions->tabletWidth()->isNotEmpty() ? $columnOptions->tabletWidth() : $layout->tabletWidth();
        $mobileWidth            = $columnOptionsExists && $columnOptions->mobileWidth()->isNotEmpty() ? $columnOptions->mobileWidth() : $layout->mobileWidth();
        $columnPadding          = $columnOptionsExists && $columnOptions->columnPadding()->isNotEmpty() ? $columnOptions->columnPadding() : null;
        $textAlign              = $columnOptionsExists && $columnOptions->textAlign()->isNotEmpty() ? $columnOptions->textAlign() : null;
        $textAlignTablet        = $columnOptionsExists && $columnOptions->textAlignTablet()->isNotEmpty() ? $columnOptions->textAlignTablet() : null;
        $textAlignMobile        = $columnOptionsExists && $columnOptions->textAlignMobile()->isNotEmpty() ? $columnOptions->textAlignMobile() : null;
        $textSize               = $columnOptionsExists && $columnOptions->textSize()->isNotEmpty() ? $columnOptions->textSize() : null;
        $textTransform          = $columnOptionsExists && $columnOptions->textTransform()->isNotEmpty() ? $columnOptions->textTransform() : null;
        $textWrapping           = $columnOptionsExists && $columnOptions->textWrapping()->isNotEmpty() ? $columnOptions->textWrapping() : null;
        $columnClass            = $columnOptionsExists && $columnOptions->columnClass()->isNotEmpty() ? ' ' . $columnOptions->columnClass() : null;
        $columnID               = $columnOptionsExists && $columnOptions->columnID()->isNotEmpty() ? 'id="' . $columnOptions->columnID() . '" ' : null;
        $columnHidden           = $columnOptionsExists && $columnOptions->hidden()->isNotEmpty() ? $columnOptions->hidden() : null;
        $columnVisible          = $columnOptionsExists && $columnOptions->visible()->isNotEmpty() ? $columnOptions->visible() : null;
        $itemFirst              = $columnOptionsExists && $columnOptions->itemFirst()->isNotEmpty() ? $columnOptions->itemFirst() : null;
        $itemLast               = $columnOptionsExists && $columnOptions->itemLast()->isNotEmpty() ? $columnOptions->itemLast() : null;
        $columnHeight           = $columnOptionsExists && $columnOptions->columnHeight()->isNotEmpty() && $columnOptions->columnHeight() != 'viewport' ? $columnOptions->columnHeight() : null;
        $viewportHeight         = $columnOptionsExists && $columnOptions->columnHeight() == 'viewport' ? ' uk-height-viewport' : null;
        $columnMinHeight        = $columnOptionsExists && $columnOptions->columnMinHeight()->isNotEmpty() ? 'min-height:' . $columnOptions->columnMinHeight() . ';' : null;
        $columnMaxHeight        = $columnOptionsExists && $columnOptions->columnMaxHeight()->isNotEmpty() ? 'max-height:' . $columnOptions->columnMaxHeight() . ';' : null;
        $columnTile             = $columnOptionsExists && $columnOptions->columnStyle() == 'tile' && $columnOptions->columnTile()->isNotEmpty() ? $columnOptions->columnTile() : null;
        $borderRounded          = $columnOptionsExists && $columnOptions->borderRounded()->isTrue() ? ' uk-border-rounded' : null;
        $columnShadow           = $columnOptionsExists && $columnOptions->columnShadow()->isNotEmpty() ? $columnOptions->columnShadow() : null;
        $columnBackground       = $columnOptionsExists && $columnOptions->columnStyle() == 'background' && $columnOptions->columnBackground()->isNotEmpty() && $columnOptions->columnBackground() != "custom" ? $columnOptions->columnBackground() : null;
        $columnTextColor        = $columnOptionsExists && $columnOptions->columnStyle() == 'background' && $columnOptions->columnTextColor()->isNotEmpty() ? $columnOptions->columnTextColor() : null;
        $customBackground       = $columnOptionsExists && $columnOptions->columnStyle() == 'background' && $columnOptions->columnBackground() == "custom" ? ' uk-cover-container' : null;
        $columnAnimation        = $columnOptionsExists && $columnOptions->animationSwitch()->isTrue() ? ' uk-scrollspy="cls:' . $columnOptions->animationType()->or('uk-animation-fade') . '; delay:' . $columnOptions->animationDelay()->or('200')->toInt() . '"' : null;
            
        ?>
        <div <?= $columnID ?>class="<?= $mobileWidth ?><?= $tabletWidth ?><?= $columnWidth ?><?= $columnTile ?><?= $columnCard ?><?= $columnBackground ?><?= $columnTextColor ?><?= $columnCardColor ?><?= $columnCardSize ?><?= $columnCardHover ?><?= $columnPadding ?><?= $textAlignMobile ?><?= $textAlignTablet ?><?= $textAlign ?><?= $textSize ?><?= $textTransform ?><?= $textWrapping ?><?= $columnClass ?><?= $columnHidden ?><?= $columnVisible ?><?= $itemFirst ?><?= $itemLast ?><?= $columnHeight ?><?= $borderRounded ?><?= $columnShadow ?><?= $customBackground ?>"<?php e($columnOptionsExists && ($columnOptions->columnMinHeight()->isNotEmpty() or $columnOptions->columnMaxHeight()->isNotEmpty()), ' style="' . $columnMinHeight . $columnMaxHeight . '"', null) ?><?= $viewportHeight ?><?= $columnAnimation ?>>
            <?php if($columnOptionsExists && $columnOptions->columnStyle() == 'background' && $columnOptions->columnBackground() == "custom"): ?>
                <?php if($columnOptions->backgroundStyle() == 'image'): ?>
                    <?php if($img = $columnOptions->backgroundImage()->toFile()): ?>
                    <div class="uk-position-cover<?= $columnOptions->backgroundImagePosition() ?><?= $columnOptions->backgroundImageSize() ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-blend-mode: overlay; background-repeat:<?= $columnOptions->backgroundImageRepeat() ?>"<?php e($columnOptions->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -200"') ?><?php e($columnOptions->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img></div>
                    <?php endif ?>
                <?php elseif($columnOptions->backgroundStyle() == 'video'): ?>
                    <?php if($columnOptions->mediaVideoSource() == "upload"): ?>
                    <?php if($video = $columnOptions->mediaVideo()->toFile()): ?>
                    <video src="<?= $video->url() ?>" autoplay loop muted playsinline uk-cover></video>
                    <?php endif ?>
                    <?php elseif($columnOptions->mediaVideoUrl()->isNotEmpty()): ?>
                    <iframe src="<?= $columnOptions->mediaVideoUrl() ?>" width="1920" height="1080" frameborder="0" allowfullscreen uk-cover></iframe>
                    <?php endif ?>
                <?php endif ?>
                <div class="uk-position-cover" style="<?php if($columnOptions->backgroundGradientOverlay()->isTrue()): ?>background-image: linear-gradient(<?php e($columnOptions->backgroundGradientTransition()->isNotEmpty(), $columnOptions->backgroundGradientTransition() . ', ') ?><?= $columnOptions->backgroundOverlayColor() ?>, <?= $columnOptions->backgroundOverlayColor2() ?>)<?php else: ?>background-color: <?= $columnOptions->backgroundOverlayColor() ?><?php endif ?>; background-blend-mode: overlay;  "></div>
            <div class="uk-position-relative">
            <?= $column->blocks() ?>
            </div>
            <?php else: ?>
            <?= $column->blocks() ?>
            <?php endif ?>
        </div>
        <?php endforeach ?>
        </div>
    </div>
    <?php if($layout->shapeDividertoggle()->isTrue() && $layout->shapeDividerposition() != 'top'): ?>
    <div class="tm-shape-divider-wrap" data-style="<?= $layout->shapeDivider()->value() ?>" data-position="bottom" style="bottom:-1px;<?php e($layout->shapeDividerheight()->isNotEmpty(), ' height:' . $layout->shapeDividerheight() . ';', 'height:150px;') ?>">
        <?php snippet('layout/shape-divider', ['layout' => $layout]) ?>
    </div>
    <?php endif ?>
</section>