<?php 
    $all_articles = $page->parent()->children()->listed()->sortBy('date')->flip();
?>

<aside class="uk-margin-large-bottom">
  <?php if($page->parent()->sidebarArticleLatestPosts() == "true"): ?>
  <!-- About -->
  <div class="tm-sidebar-block">
  <h4><?= $site->labelLatestPosts()->html() ?></h4>
    <?php foreach($articles as $article): ?>
      <div>
      <h5><a href="<?= $article->url() ?>"><?= $article->title()->html() ?></a></h5>
      </div>
    <?php endforeach ?>
    </div>
  <?php endif ?>
  <?php if($page->parent()->sidebarArticleCategories() == "true" && count($all_articles->pluck('category', ',', true)) > null): ?>
  <!-- Categories -->
  <div class="tm-sidebar-block">
    <h4><?= $site->labelCategories()->html() ?></h4>
    <ul class="uk-list uk-list-divider">
      <?php foreach($all_articles->pluck('category', ',', true) as $category): ?>
      <li>
        <a href="<?= url($lang . '/' . $page->parent()->slug(), ['params' => ['category' => urlencode($category)]]) ?>">
          <?= Str::ucfirst($category) ?>
        </a> <sup>(<?= $all_articles->filterBy('category', $category)->count() ?>)</sup>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
  <?php endif ?>

  <?php if($page->parent()->sidebarArticleArchive() == "true" && $all_articles->count() > null): ?>
  <!-- Archive -->
  <div class="tm-sidebar-block">
    <h4><?= $site->labelArchive()->html() ?></h4>
    <ul class="uk-list uk-list-divider">
      <?php foreach ($all_articles->group(function ($p) { return $p->date()->toDate('Y'); }) as $year => $yearList): ?>
        <li>
          <a href="<?= url($lang . '/' . $page->parent()->slug(), ['params' => ['year' => $year]]) ?>">
            <?= $year ?>
          </a>
          <sup>(<?= $all_articles->filter(function($p) use($year) { return $p->date()->toDate('Y') == $year;})->count() ?>)</sup>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
  <?php endif ?>

  <?php if($page->parent()->sidebarArticleTags() == "true" && count($all_articles->pluck('tags', ',', true)) > null): ?>
  <!-- Tags -->
  <div class="tm-sidebar-block">
    <h4><?= $site->labelTags()->html() ?></h4>
    <div>
      <?php foreach($all_articles->pluck('tags', ',', true) as $tag): ?>
      <a href="<?= url($lang . '/' . $page->parent()->slug(), ['params' => ['tag' => urlencode($tag)]]) ?>"><span class="uk-label">#<?= $tag ?></span></a>
      <?php endforeach ?>
    </div>
  </div>
  <?php endif ?>

  <?php if($page->parent()->sidebarArticleSocialmedia() == "true" && $site->social()->toStructure()->isNotEmpty()): ?>
  <!-- Social Media -->
  <div class="tm-sidebar-block">
    <h4><?= $site->labelStayconnected()->html() ?></h4>
    <?php foreach($site->social()->toStructure() as $social): ?>
    <a href="<?= $social->url() ?>" target="_blank" class="uk-icon-button uk-button-default uk-margin-small-right" uk-icon="icon: <?= Str::lower($social->platform()) ?>; ratio: 1;"></a>
    <?php endforeach ?>
  </div>
  <?php endif ?>
</aside>