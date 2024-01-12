<?php 
    $title  = $page->isHomePage() ? ($site->metaTitle()->isNotEmpty() ?  $site->metaTitle()->html() : $site->title()->html()) : ($page->metaTitle()->isNotEmpty() ? $page->metaTitle()->html() . ' | ' . $site->title()->html() : $page->title()->html() . ' | ' . $site->title()->html()) ;
    $img    = $page->metaFile()->isNotEmpty() ? $page->metaFile()->toFile()->crop(1200, 630, 'top') : ($page->template() == "article" ? ($page->cover()->toFile() ? $page->cover()->toFile()->crop(1200, 630) : kirby()->site()->metaFile()->toFile() ) : kirby()->site()->metaFile()->toFile());
    $desc   = $page->metaDescription()->isNotEmpty() ? $page->metaDescription()->kt()->inline() : ($page->template() == "article" ? ($page->desc()->isNotEmpty() ? $page->desc()->kt()->inline() : kirby()->site()->metaDescription()->kt()->inline()) : kirby()->site()->metaDescription()->kt()->inline());
    $author = $page->author()->isNotEmpty() ? $page->author()->toUser()->name() : kirby()->site()->author();
    $type   = $page->template() == "article" ? 'article' : 'website';
?>

<meta property="og:title" content="<?= $title ?>" />
<meta property="og:type" content="<?= $type ?>">
<meta property="og:url" content="<?= $page->url() ?>" />
<?php if($img): ?>
<meta property="og:image" content="<?= $img->url() ?>" />
<meta property="og:image:width" content="<?= $img->width() ?>" />
<meta property="og:image:height" content="<?= $img->height() ?>" />
<?php if($img->alt()->isNotEmpty()): ?>
<meta property="og:image:alt" content="<?= $img->alt()->html() ?>" />
<?php endif ?>
<meta property="og:image:type" content="<?= $img->type() ?>/<?= $img->extension() ?>" />
<?php endif ?>
<?php if($page->template() == "article"): ?>
<meta property="article:published_time" content="<?= $page->date()->toDate('c') ?>" />
<meta property="article:author" content="<?= $author ?>" />
<?php if($page->category()->isNotEmpty()): ?>
<meta property="article:section" content="<?= $page->category() ?>" />
<?php endif ?>
<?php endif ?>
<meta property="og:site_name" content="<?= $site->title() ?>" />
<meta property="og:description" content="<?= $desc ?>" />