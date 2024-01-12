<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php 

$headingStyle       = $data->headingStyle()->isNotEmpty() ? $data->headingStyle() : null;
$headingSize        = $data->headingSize()->isNotEmpty() ? $data->headingSize() : null;
$headingColor       = $data->headingColor()->isNotEmpty() ? $data->headingColor() : null;
$textAlign          = $data->textAlign()->isNotEmpty() ? $data->textAlign() : null;
$textAlignTablet    = $data->textAlignTablet()->isNotEmpty() ? $data->textAlignTablet() : null;
$textAlignMobile    = $data->textAlignMobile()->isNotEmpty() ? $data->textAlignMobile() : null;
$textTransform      = $data->textTransform()->isNotEmpty() ? $data->textTransform() : null;
$textWrapping       = $data->textWrapping()->isNotEmpty() ? $data->textWrapping() : null;

?>
<<?= $level = $data->level()->or('h2') ?><?php if($headingStyle or $headingSize or $headingColor or $textAlign or $textAlignTablet or $textAlignMobile or $textTransform or $textWrapping): ?> class="<?= $headingStyle ?><?= $headingSize ?><?= $headingColor ?><?= $textAlign ?><?= $textAlignTablet ?><?= $textAlignMobile ?><?= $textTransform ?><?= $textWrapping ?>"<?php endif ?>>
    <?php if($headingStyle == "uk-heading-line"): ?><span><?= $block->text() ?></span><?php else : ?><?= $block->text() ?><?php endif ?>
</<?= $level ?>>