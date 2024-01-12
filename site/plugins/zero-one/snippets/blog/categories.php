<!-- categories tagcloud -->
<ul class="uk-subnav uk-subnav-divider<?php e($site->headerAlign() == "center", ' uk-flex-center') ?>" uk-margin>
<?php foreach($all_articles->pluck('category', ',', true) as $category): ?>
  <li>
    <a href="<?= url($lang . '/' . $page->slug(), ['params' => ['category' => urlencode($category)]]) ?>"><?= $category ?></a> <sup>(<?= $all_articles->filterBy('category', $category)->count() ?>)</sup>
  </li>
  <?php endforeach ?>
</ul>