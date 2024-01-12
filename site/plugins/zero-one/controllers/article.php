<?php

return function ($kirby, $site, $pages, $page) {
    $lang = $kirby->languages()->isNotEmpty() ? $kirby->language() : null;
    $lang = $kirby->language()->isDefault() === null;
    $author = $page->author()->isNotEmpty() ? $page->author()->toUser()->name() : ($site->author()->isNotEmpty() ? $site->author()->html() : 'Author');
    $articles = $page->parent()->children()
                        ->listed()
                        ->sortBy('date')
                        ->flip()
                        ->limit(5);

    return [
      'lang' => $lang,
      'author' => $author,
      'articles' => $articles,
    ];
};
