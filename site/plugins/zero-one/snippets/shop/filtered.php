<h1><?php if (param('category')) : ?><?= $site->labelShopcategory()->html() ?> <?= Str::ucfirst($category) ?><?php endif ?><?php if (param('tag')) : ?><?= $site->labelShoptag()->html() ?> <?= Str::ucwords($tag) ?><?php endif ?></h1>
<hr class="uk-divider-small">
<p class="uk-article-meta"><?= $site->labelShoparchivetext()->html() ?> <?= Str::ucfirst($category) ?><?= Str::ucfirst($tag) ?> <?= $site->labelShoparchivename()->html() ?></p>
<p><a href="<?= $page->url() ?>"><?= $site->labelBacktoshop()->html() ?>  <?= $page->title() ?></a></p>