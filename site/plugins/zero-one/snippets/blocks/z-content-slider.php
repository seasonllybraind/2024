<?php 

$blockID          = $data->blockID()->isNotEmpty() ? 'id="' . $data->blockID()->value() . '" ' : null;
$blockClass       = $data->blockClass()->isNotEmpty() ? ' ' . $data->blockClass()->value() : null;
$marginVertical   = $data->marginVertical()->isNotEmpty() ? $data->marginVertical() : null;
$marginLeft       = $data->marginLeft()->isNotEmpty() ? $data->marginLeft() : null;
$marginRight      = $data->marginRight()->isNotEmpty() ? $data->marginRight() : null;
$animation        = $data->animationSwitch()->isTrue() ? ' uk-scrollspy="cls:' . $data->animationType()->or('uk-animation-fade') . '; delay:' . $data->animationDelay()->or('200')->toInt() . '"' : null;
$itemWidth        = $data->sliderItemWidth()->isNotEmpty() ? $data->sliderItemWidth() : null;
$itemsGap         = $data->sliderItemsGap()->isNotEmpty() ? $data->sliderItemsGap() : null;
$centerItems      = $data->centerItems()->isTrue() ? 'center: true;' : null;
$autoplay         = $data->autoplay()->isTrue() ? 'autoplay: true;' : null;
$finite           = $data->finite()->isTrue() ? 'finite: true;' : 'finite: false;';
$slideSets        = $data->slideSets()->isTrue() ? 'sets: true;' : null;
$arrowsOut        = $data->navigationArrows() == 'out' ? ' uk-visible@m' : ' uk-hidden';
$arrowsInside     = $data->navigationArrows() == 'inside' ? null : ' uk-hidden@m';
$arrowsColor      = $data->navigationArrowsColor()->isNotEmpty() ? $data->navigationArrowsColor() : null;
$verticalAlign    = $data->verticalAlign()->isNotEmpty() ? $data->verticalAlign() : null;

?>
<div <?= $blockID ?>class="<?= $blockClass ?><?= $marginVertical ?><?= $marginLeft ?><?= $marginRight ?>"<?= $animation ?>>
<div class="uk-slider-container-offset" uk-slider="<?= $centerItems ?><?= $autoplay ?><?= $finite ?><?= $slideSets ?>">
    <div class="uk-position-relative uk-visible-toggle" tabindex="-1">
    <div class="uk-slider-container">
        <ul class="uk-slider-items uk-grid<?= $verticalAlign ?><?= $itemsGap ?>">
        <?php
        // using the `toStructure()` method, we create a structure collection
        $items = $data->sliderContent()->toStructure();
        // we can then loop through the entries and render the individual fields
        foreach ($items as $item): ?>
            <li class="uk-width-1-1<?= $itemWidth ?>">
            <?php if($item->slideTile() == "true"): ?><div class="uk-tile<?= $item->slideTileSize() ?><?= $item->slideTileColor() ?><?php e($item->slideTileBorderRadius() == "true", ' uk-border-rounded') ?>"><?php endif ?>
                <?= $item->slideContent()->toBlocks() ?>
            <?php if($item->slideTile() == "true"): ?></div><?php endif ?>
            </li>
        <?php endforeach ?>
        </ul>
        <div class="<?= $arrowsColor ?><?= $arrowsInside ?>">
            <a class="uk-position-center-left uk-slidenav-large" href="#" data-no-swup uk-slidenav-previous uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-slidenav-large" href="#" data-no-swup uk-slidenav-next uk-slider-item="next"></a>
        </div>
        <div class="<?= $arrowsColor ?><?= $arrowsOut ?>">
            <a class="uk-position-center-left-out uk-slidenav-large uk-position-small" href="#" data-no-swup uk-slidenav-previous uk-slider-item="previous"></a>
            <a class="uk-position-center-right-out uk-slidenav-large uk-position-small" href="#" data-no-swup uk-slidenav-next uk-slider-item="next"></a>
        </div>
    </div>
    </div>
    <?php if ($data->navigationBullets()->isTrue()): ?>
    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
    <?php endif ?>
</div>
</div>