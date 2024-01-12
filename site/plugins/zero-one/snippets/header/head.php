<?php snippet('header/head/title') ?>

<link rel="canonical" href="<?= $page->url() ?>" />
<?php if($kirby->languages()->isNotEmpty() && $kirby->languages()->count() > 1): ?>
<?php foreach($kirby->languages() as $language): ?>
<?php if($page->translation($language->code())->exists()): ?>
<link rel="alternate" hreflang="<?= $language->code(); ?>" href="<?= $page->url($language->code()); ?>" />
<?php endif ?>
<?php endforeach ?>
<link rel="alternate" hreflang="x-default" href="<?= $page->url($kirby->defaultLanguage()->code()); ?>" />
<?php endif ?>
<?php snippet('header/head/seo') ?>
<?php snippet('header/head/opengraph') ?>
<?php snippet('header/head/twitter') ?>
<?php snippet('header/head/favicon') ?>
<?php if($site->useSchema()->isTrue()): ?>
<?php snippet('header/head/schema') ?>
<?php endif ?>