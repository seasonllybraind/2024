<!-- categories tagcloud -->
<ul class="uk-subnav uk-subnav-divider<?php e($site->headerAlign() == "center", ' uk-flex-center') ?>" uk-margin>
<?php foreach($all_products->pluck('category', ',', true) as $category): ?>
  <?php $current = kirby()->request()->params()->category(); ?>
  <li <?php e($category == $current, ' class="uk-active"') ?>>
    <a href="<?= url($lang . '/' . $page->slug(), ['params' => ['category' => urlencode($category)]]) ?>"<?php e($category == $current, ' class="uk-text-bold"') ?>><?= $category ?></a> <sup>(<?= $all_products->filterBy('category', $category)->count() ?>)</sup>
  </li>
  <?php endforeach ?>
</ul>