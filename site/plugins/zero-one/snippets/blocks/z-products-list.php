<?php 

$blockID          = $data->blockID()->isNotEmpty() ? ' id="' . $data->blockID()->value() . '"' : null;
$blockClass       = $data->blockClass()->isNotEmpty() ? ' class="' . $data->blockClass()->value() . '"' : null;
$columnWidth      = $data->columnWidth()->isNotEmpty() ? ' ' . $data->columnWidth() : ' uk-child-width-1-3@m';
$tabletWidth      = $data->tabletWidth()->isNotEmpty() ? ' ' . $data->tabletWidth() : ' uk-child-width-1-2@s';
$maxProducts      = $data->maxProducts()->isNotEmpty() ? $data->maxProducts()->toInt() : '3';
$products         = $data->productsPage()->toPages()->isNotEmpty() ? $data->productsPage()->toPages()->children()->listed()->limit($maxProducts)->sortBy('title', 'asc', SORT_LOCALE_STRING) : ($data->products()->toPages()->count() > 0 ? $data->products()->toPages() : $kirby->collection('products')->limit($maxProducts)->sortBy('title', 'asc', SORT_LOCALE_STRING));
$titleSize        = $data->titleSize()->isNotEmpty() ? $data->titleSize() : null;
$style            = $data->listStyle()->isNotEmpty() ? $data->listStyle() : null;
$color            = $data->listColor()->isNotEmpty() ? $data->listColor() : null;
$size             = $data->listSize()->isNotEmpty() ? $data->listSize() : null;
$divider          = $data->listDivider()->isNotEmpty() ? $data->listDivider() : null;
$column           = $data->column()->isNotEmpty() ? $data->column() : null;

?>
<div<?= $blockID ?><?= $blockClass ?><?php if($data->removeAnimation()->isFalse()): ?> uk-scrollspy="cls: uk-animation-slide-bottom-small; target: .tm-product-container; delay: 200"<?php endif ?>>
    <ul class="uk-list<?= $style ?><?= $color ?><?= $size ?><?= $divider ?><?= $column ?>">
    <?php foreach($products as $product): ?>
        <li><h5 class="uk-margin-remove-bottom<?= $titleSize ?>"><a class="uk-link-heading" href="<?= $product->url() ?>"><?= $product->title()->html() ?></a></h5></li>
    <?php endforeach ?>
    </ul>
</div>