<!-- tags -->
<ul class="uk-subnav uk-subnav-divider<?php e($site->headerAlign() == "center", ' uk-flex-center') ?>" uk-margin>
<?php foreach($all_projects->pluck('tags', ',', true) as $tag): ?>
<?php $tagged = urldecode(param('tag') ?? ''); ?>
  <li<?php e($tag == $tagged, ' class="uk-active uk-text-bold"') ?>>
    <a href="<?= url($lang . '/' . $page->slug(), ['params' => ['tag' => urlencode($tag)]]) ?>"><?= Str::ucfirst($tag) ?></a>
  </li>
  <?php endforeach ?>
</ul>