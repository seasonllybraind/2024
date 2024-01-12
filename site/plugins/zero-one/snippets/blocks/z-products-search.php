<?php

$blockID          = $data->blockID()->isNotEmpty() ? 'id="' . $data->blockID()->value() . '" ' : null;
$blockClass       = $data->blockClass()->isNotEmpty() ? ' ' . $data->blockClass()->value() : null;
$marginVertical   = $data->marginVertical()->isNotEmpty() ? $data->marginVertical() : null;
$marginLeft       = $data->marginLeft()->isNotEmpty() ? $data->marginLeft() : null;
$marginRight      = $data->marginRight()->isNotEmpty() ? $data->marginRight() : null;
$animation        = $data->animationSwitch()->isTrue() ? ' uk-scrollspy="cls:' . $data->animationType()->or('uk-animation-fade') . '; delay:' . $data->animationDelay()->or('200')->toInt() . '"' : null;
$placeholder      = $data->searchPlaceholder()->isNotEmpty() ? $data->searchPlaceholder() : 'Search products...';
$searchStyle      = $data->searchStyle()->isNotEmpty() ? $data->searchStyle() : null;
$searchAlign      = $data->searchAlign()->isNotEmpty() ? $data->searchAlign() : null;

?>
<div <?= $blockID ?>class="uk-flex<?= $searchAlign ?><?= $blockClass ?><?= $marginVertical ?><?= $marginLeft ?><?= $marginRight ?>"<?= $animation ?>>
<form class="uk-search<?= $searchStyle ?>" method="get" action="<?= page('search')->url() ?>/products">
  <a href="" class="uk-search-icon-flip" uk-search-icon></a>
  <input class="uk-search-input" type="search" name="q" placeholder="<?= $placeholder ?>">
</form>
</div>