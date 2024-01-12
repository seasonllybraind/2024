<?php 
    $author = $page->author()->isNotEmpty() ? $page->author()->toUser()->name() : kirby()->site()->author();
    $desc = $page->metaDescription()->isNotEmpty() ? $page->metaDescription()->kt()->inline() : ($page->template() == "article" ? ($page->desc()->isNotEmpty() ? $page->desc()->kt()->inline() : kirby()->site()->metaDescription()->kt()->inline()) : kirby()->site()->metaDescription()->kt()->inline());
    $robot = (urldecode(param('tag') ?? '') OR urldecode(param('category') ?? '') OR (urldecode(param('year') ?? '') and urldecode(param('month') ?? '')) OR $page->template() == "error" OR ($page->sitemap()->exists() and $page->sitemap()->isFalse())) ? 'noindex,nofollow' : 'index,follow,noodp';
?>

<meta content="<?= $author ?>" name="author" />
<meta content="<?= $desc ?>" name="description" />
<meta content="<?= $robot ?>" name="robots" />