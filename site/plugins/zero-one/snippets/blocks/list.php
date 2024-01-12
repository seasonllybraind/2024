<?php /** @var \Kirby\Cms\Block $block */ 

    $list = $block->text();
    $style = $data->listStyle();
    $color = $data->listColor();
    $size = $data->listSize();
    $divider = $data->listDivider();
    $column = $data->column();

    $list = preg_replace('/<ul>/', '<ul class="uk-list' . $style . $color . $size . $divider . $column . '">', $list);
    echo $list;