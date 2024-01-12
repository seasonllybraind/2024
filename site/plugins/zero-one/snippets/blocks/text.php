

<?php /** @var \Kirby\Cms\Block $block */ ?>

<?php 
$text                   = $data->text();
$textAlign              = $data->textAlign()->isNotEmpty() ? $data->textAlign() : null;
$textAlignTablet        = $data->textAlignTablet()->isNotEmpty() ? $data->textAlignTablet() : null;
$textAlignMobile        = $data->textAlignMobile()->isNotEmpty() ? $data->textAlignMobile() : null;
$textSize               = $data->textSize()->isNotEmpty() ? $data->textSize() : null;
$textTransform          = $data->textTransform()->isNotEmpty() ? $data->textTransform() : null;
$textWrapping           = $data->textWrapping()->isNotEmpty() ? $data->textWrapping() : null;
$textColor              = $data->textColor()->isNotEmpty() ? $data->textColor() : null;

if($textAlign or $textAlignTablet or $textAlignMobile or $textSize or $textTransform or $textWrapping or $textColor) {
  $text = preg_replace('/<p>/', '<p class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<h1>/', '<h1 class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<h2>/', '<h2 class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<h3>/', '<h3 class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<h4>/', '<h4 class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<h5>/', '<h5 class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<h6>/', '<h6 class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<ul>/', '<ul class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
  $text = preg_replace('/<ol>/', '<ol class="' . $textAlign . $textAlignTablet . $textAlignMobile . $textSize . $textTransform . $textWrapping . $textColor . '">', $text);
}
echo $text;