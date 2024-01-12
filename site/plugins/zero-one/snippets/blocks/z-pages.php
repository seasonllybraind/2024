<?php

$navStyle       = ($block->navigationStyle()->isEmpty() or $block->navigationStyle() == "list") ? 'uk-list' : ($block->navigationStyle() == "nav" ? 'uk-nav' : 'uk-subnav');
$listStyle      = ($block->navigationStyle()->isEmpty() or $block->navigationStyle() == "list") ? $block->listStyle() : null;
$listColor      = ($block->navigationStyle()->isEmpty() or $block->navigationStyle() == "list") ? $block->listColor() : null;
$listSize       = ($block->navigationStyle()->isEmpty() or $block->navigationStyle() == "list") ? $block->listSize() : null;
$listDivider    = ($block->navigationStyle()->isEmpty() or $block->navigationStyle() == "list") ? $block->listDivider() : null;
$listColumn     = $block->navigationStyle() == "list" ? $block->column() : null;
$navDefault     = ($block->navigationStyle() == "nav" & $block->navDefault()->isTrue()) ? ' uk-nav-default' : null;
$navCenter      = ($block->navigationStyle() == "nav" & $block->navCenter()->isTrue()) ? ' uk-nav-center' : null;
$subnavDivider  = ($block->navigationStyle() == "subnav" & $block->subnavDivider()->isTrue()) ? ' uk-subnav-divider' : null;
$subnavPill     = ($block->navigationStyle() == "subnav" & $block->subnavPill()->isTrue()) ? ' uk-subnav-pill' : null;

// selective items
if ($block->pages() == "child") {
    $items = $page->children()->listed();
} elseif($block->pages() == "sibling") {
    $items = $page->siblings()->listed();
} elseif($block->pages() == "custom") {
  $items = $block->pagesParent()->toPage()->isNotEmpty() ? $block->pagesParent()->toPage()->children()->listed() : null;
} else {
    $items = $site->children()->listed();
}

// only show the menu if items are available
if($items and $items->isNotEmpty()):

?>
<nav<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?><?php if($data->blockClass()->isNotEmpty()): ?> class="<?= $data->blockClass()->value() ?>"<?php endif ?>>
  <ul class="<?= $navStyle ?><?= $listStyle ?><?= $listColor ?><?= $listSize ?><?= $listDivider ?><?= $listColumn ?><?= $navDefault ?><?= $navCenter ?><?= $subnavDivider ?><?= $subnavPill ?>">
    <?php foreach($items as $item): ?>
    <li><a<?php e($item->isOpen(), ' class="uk-text-emphasis uk-disabled"') ?> href="<?= $item->url() ?>"><?= $item->title()->html() ?></a></li>
    <?php endforeach ?>
  </ul>
</nav>
<?php endif ?>