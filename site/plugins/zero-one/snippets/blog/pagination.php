<?php if ($pagination->hasNextPage() or $pagination->hasPrevPage()): ?>
<!-- Pagination -->
<div class="uk-flex uk-flex-center uk-margin-large" uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: 300">
<nav aria-label="pagination">
  <ul class="uk-pagination" uk-margin>
    
    <?php if ($pagination->hasPrevPage()): ?>
    <li>
      <a href="<?= $pagination->prevPageURL() ?>"><span uk-pagination-previous></span></a>
    </li>
    <?php else: ?>
    <li class="uk-disabled">
      <a href=""><span uk-pagination-previous></span></a>
    </li>
    <?php endif ?>

    <?php foreach ($pagination->range(7) as $r): ?>
    <li <?= $pagination->page() === $r ? 'class="uk-active"' : '' ?>>
      <a<?= $pagination->page() === $r ? ' aria-current="page"' : '' ?> href="<?= $pagination->pageURL($r) ?>"><?= $r ?></a>
    </li>
    <?php endforeach ?>

    <?php if ($pagination->hasNextPage()): ?>
    <li>
      <a href="<?= $pagination->nextPageURL() ?>"><span uk-pagination-next></span></a>
    </li>
    <?php else: ?>
    <li class="uk-disabled">
      <span><span uk-pagination-next></span></span>
    </li>
    <?php endif ?>

    </ul>
</nav>
</div>
<?php endif ?>
