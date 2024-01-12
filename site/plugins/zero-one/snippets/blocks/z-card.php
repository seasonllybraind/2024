<?php 

$blockID            = $data->blockID()->isNotEmpty() ? 'id="' . $data->blockID()->value() . '" ' : null;
$blockClass         = $data->blockClass()->isNotEmpty() ? ' ' . $data->blockClass()->value() : null;
$marginVertical     = $data->marginVertical()->isNotEmpty() ? $data->marginVertical() : null;
$marginLeft         = $data->marginLeft()->isNotEmpty() ? $data->marginLeft() : null;
$marginRight        = $data->marginRight()->isNotEmpty() ? $data->marginRight() : null;
$animation          = $data->animationSwitch()->isTrue() ? ' uk-scrollspy="cls:' . $data->animationType()->or('uk-animation-fade') . '; delay:' . $data->animationDelay()->or('200')->toInt() . '"' : null;
$cardSize           = $data->cardSize()->isNotEmpty() ? $data->cardSize() : null;
$cardHover          = $data->cardHover()->isTrue() ? ' uk-card-hover' : null;
$cardColor          = $data->cardColor()->isNotEmpty() && $data->cardColor() != "custom" ? $data->cardColor() : null;
$textColor          = $data->cardColor() == 'custom' && $data->textColor()->isNotEmpty() ? $data->textColor() : null;
$customBackground   = $data->cardColor() == "custom" ? ' uk-cover-container' : null;

if ($image = $data->cardImage()->toImage()) {
    $alt            = $data->cardMediaAlt()->isNotEmpty() ? $data->cardMediaAlt() : $image->alt();
    $src            = $data->cardMediaResizeWidth()->isNotEmpty() ? $image->clip($data->cardMediaResizeWidth()->toInt())->url() : $image->clip()->url();
    $srcurl         = $image->url();
    $srcset         = $data->cardMediaResizeWidth()->isNotEmpty() ? $image->thumb(['clip' => $image->getClip(), 'width' => $data->cardMediaResizeWidth()->toInt(), 'format' => 'webp'])->url() : $image->thumb(['clip' => $image->getClip(), 'format' => 'webp'])->url();
    $width          = $data->cardMediaResizeWidth()->isNotEmpty() ? $image->clip($data->cardMediaResizeWidth()->toInt())->width() : $image->clip()->width();
    $height         = $data->cardMediaResizeWidth()->isNotEmpty() ? $image->clip($data->cardMediaResizeWidth()->toInt())->height() : $image->clip()->height();
}

$linkType           = $data->cardLinkType()->value();
$page               = $linkType === 'page' ? $data->cardLinkInternal()->toPage() : null;
$link               = $page ? $page->url() : ($linkType === 'custom' ? $block->cardLinkUrl()->value() : null);

?>
<?php if(!empty($link)): ?><a href="<?= $link ?>" class="uk-link-toggle"<?php e($data->target() == "true", ' target="_blank"') ?>><?php endif; ?>
<div <?= $blockID ?>class="uk-card<?= $cardSize ?><?= $cardHover ?><?= $cardColor ?><?= $textColor ?><?= $customBackground ?><?= $blockClass ?><?= $marginVertical ?><?= $marginLeft ?><?= $marginRight ?>"<?= $animation ?>>
<?php if($data->cardBadge()->isNotEmpty()): ?><div class="uk-card-badge uk-label"><?= $data->cardBadge() ?></div><?php endif ?>
<?php if($data->cardColor() == 'custom'): ?>
<?php if($data->backgroundStyle() == 'image'): ?>
    <?php if($img = $data->backgroundImage()->toFile()): ?>
    <div class="uk-position-cover<?= $data->backgroundImagePosition() ?><?= $data->backgroundImageSize() ?><?php e($site->siteBorderRadius() == "true", ' uk-border-rounded') ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-blend-mode: overlay; background-repeat:<?= $data->backgroundImageRepeat() ?>"<?php e($data->backgroundParalax() == "paralaxY", ' uk-parallax="bgy: -200"') ?><?php e($data->backgroundParalax() == "paralaxX", ' uk-parallax="bgx: -100"') ?> uk-img></div>
    <?php endif ?>
<?php elseif($data->backgroundStyle() == 'video'): ?>
    <?php if($data->mediaVideoSource() == "upload"): ?>
    <?php if($video = $data->mediaVideo()->toFile()): ?>
    <video src="<?= $video->url() ?>" autoplay loop muted playsinline uk-cover></video>
    <?php endif ?>
    <?php elseif($data->mediaVideoUrl()->isNotEmpty()): ?>
    <iframe src="<?= $data->mediaVideoUrl() ?>" width="1920" height="1080" frameborder="0" allowfullscreen uk-cover></iframe>
    <?php endif ?>
<?php endif ?>
<div class="uk-position-cover<?php e($site->siteBorderRadius() == "true", ' uk-border-rounded') ?>" style="<?php if($data->backgroundGradientOverlay()->isTrue()): ?>background-image: linear-gradient(<?php e($data->backgroundGradientTransition()->isNotEmpty(), $data->backgroundGradientTransition() . ', ') ?><?= $data->backgroundOverlayColor() ?>, <?= $data->backgroundOverlayColor2() ?>)<?php else: ?>background-color: <?= $data->backgroundOverlayColor() ?><?php endif ?>; background-blend-mode: overlay;  "></div>
<?php if($data->cardMediaSwitch()->isTrue() && $data->cardMediaPosition() == 'top' && $image = $data->cardImage()->toImage()): ?>
<div class="uk-card-media-top uk-position-relative">
    <picture>
        <source type="image/webp" srcset="<?= $srcset ?>" />
        <img src="<?= $src ?>" alt="<?= $alt ?>" width="<?= $width ?>" height="<?= $height ?>" loading="lazy">
    </picture>
</div>
<?php endif ?>
<div class="uk-card-body uk-position-relative">
<?= $data->blocks()->toBlocks() ?>
</div>
<?php if($data->cardMediaSwitch()->isTrue() && $data->cardMediaPosition() == 'bottom' && $image = $data->cardImage()->toImage()): ?>
<div class="uk-card-media-bottom uk-position-relative">
    <picture>
        <source type="image/webp" srcset="<?= $srcset ?>" />
        <img src="<?= $src ?>" alt="<?= $alt ?>" width="<?= $width ?>" height="<?= $height ?>" loading="lazy">
    </picture>
</div>
<?php endif ?>
<?php else: ?>
<?php if($data->cardMediaSwitch()->isTrue() && $data->cardMediaPosition() == 'top' && $image = $data->cardImage()->toImage()): ?>
<div class="uk-card-media-top">
    <picture>
        <source type="image/webp" srcset="<?= $srcset ?>" />
        <img src="<?= $src ?>" alt="<?= $alt ?>" width="<?= $width ?>" height="<?= $height ?>" loading="lazy">
    </picture>
</div>
<?php endif ?>
<div class="uk-card-body">
<?= $data->blocks()->toBlocks() ?>
</div>
<?php if($data->cardMediaSwitch()->isTrue() && $data->cardMediaPosition() == 'bottom' && $image = $data->cardImage()->toImage()): ?>
<div class="uk-card-media-bottom">
    <picture>
        <source type="image/webp" srcset="<?= $srcset ?>" />
        <img src="<?= $src ?>" alt="<?= $alt ?>" width="<?= $width ?>" height="<?= $height ?>" loading="lazy">
    </picture>
</div>
<?php endif ?>
<?php endif ?>
</div>
<?php if(!empty($link)): ?></a><?php endif; ?>