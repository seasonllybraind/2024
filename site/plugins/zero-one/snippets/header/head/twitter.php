<?php
    $title  = $page->isHomePage() ? ($site->metaTitle()->isNotEmpty() ?  $site->metaTitle()->html() : $site->title()->html()) : ($page->metaTitle()->isNotEmpty() ? $page->metaTitle()->html() . ' | ' . $site->title()->html() : $page->title()->html() . ' | ' . $site->title()->html()) ;
    $img    = $page->metaFile()->isNotEmpty() ? $page->metaFile()->toFile()->crop(1200, 630, 'top') : ($page->template() == "article" ? ($page->cover()->toFile() ? $page->cover()->toFile()->crop(1200, 630) : kirby()->site()->metaFile()->toFile() ) : kirby()->site()->metaFile()->toFile());
    $desc   = $page->metaDescription()->isNotEmpty() ? $page->metaDescription()->kt()->inline() : ($page->template() == "article" ? ($page->desc()->isNotEmpty() ? $page->desc()->kt()->inline() : kirby()->site()->metaDescription()->kt()->inline()) : kirby()->site()->metaDescription()->kt()->inline());
    $author = $page->author()->isNotEmpty() ? $page->author()->toUser()->twitter() : site()->twitteruser();
?>

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= $title ?>" />
<meta name="twitter:description" content="<?= $desc ?>" />
<?php if ($site->twitteruser()->isNotEmpty()): ?>
<meta name="twitter:site" content="<?= $site->twitteruser() ?>" />
<meta name="twitter:creator" content="<?= $author ?>" />
<?php endif ?>
<?php if($img): ?>
<meta name="twitter:image" content="<?= $img->url() ?>" />
<?php endif ?>
