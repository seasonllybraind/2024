<nav class="uk-visible@s" role="navigation">
  <ul class="uk-breadcrumb">
    <?php foreach($site->breadcrumb() as $crumb): ?>
    <li>
      <a<?php e($crumb->isActive(), ' class="uk-disabled"') ?> href="<?= $crumb->url() ?>"><?= html($crumb->title()) ?></a>
    </li>
    <?php endforeach ?>
  </ul>
</nav>