<?php

return function ($kirby, $site, $pages, $page) {
    $perpage  = $page->perpage()->int();

    $all_articles = $page->children()
                          ->listed()
                          ->sortBy('date')
                          ->flip();

    $tag = urldecode(param('tag') ?? '');
    $category = urldecode(param('category') ?? '');
    $year = urldecode(param('year') ?? '');

    $lang = $kirby->languages()->isNotEmpty() ? $kirby->language() : null;
    $lang = $kirby->language()->isDefault() === null;
    $langfilter = function ($child) {
        return kirby()->languages()->isNotEmpty() ? $child->translation(kirby()->language()->code()) : $child;
    };

    if ($tag) {
        $articles = $page->children()
                          ->listed()
                          ->filter($langfilter)
                          ->filterBy('tags', $tag, ',')
                          ->sortBy('date')
                          ->flip();
        if ($articles->count() == 0) {
            go('error');
        }
    } elseif ($category) {
        $articles = $page->children()
                          ->listed()
                          ->filter($langfilter)
                          ->filterBy('category', $category, ',')
                          ->sortBy('date')
                          ->flip();
        if ($articles->count() == 0) {
            go('error');
        }
    } elseif ($year) {
        $articles = $page->children()
                          ->listed()
                          ->filter($langfilter)
                          ->filter(function ($p) use ($year) {
                              return $p->date()->toDate('Y') == $year;
                          })
                          ->sortBy('date')
                          ->flip();
        if ($articles->count() == 0) {
            go('error');
        }
    } else {
        $articles = $page->children()
                          ->listed()
                          ->sortBy('date')
                          ->flip();
    }

    $articles = $articles->paginate($perpage);

    return [
      'tag'          => $tag,
      'category'     => $category,
      'year'         => $year,
      'lang'         => $lang,
      'articles'     => $articles,
      'all_articles' => $all_articles,
      'pagination'   => $articles->pagination(),
    ];
};
