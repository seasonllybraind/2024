<?php

return function ($kirby, $site, $pages, $page) {
    $perpage  = $page->perpage()->int();

    $coverimg_width = $site->productImageratio() == "3:4" ? '900' : '800';
    $coverimg_height = $site->productImageratio()->isNotEmpty() ? ($site->productImageratio() == "4:3" ? '600' : '1200') : '800';

    $all_products = $page->children()
                          ->listed();

    $tag = urldecode(param('tag') ?? '');
    $category = urldecode(param('category') ?? '');

    $lang = $kirby->languages()->isNotEmpty() ? $kirby->language() : null;
    $lang = $kirby->language()->isDefault() === null;
    $langfilter = function ($child) {
        return kirby()->languages()->isNotEmpty() ? $child->translation(kirby()->language()->code()) : $child;
    };

    if ($tag) {
        $products = $page->children()
                          ->listed()
                          ->filter($langfilter)
                          ->filterBy('tags', $tag, ',');
        if ($products->count() == 0) {
            go('error');
        }
    } elseif ($category) {
        $products = $page->children()
                          ->listed()
                          ->filter($langfilter)
                          ->filterBy('category', $category, ',');
        if ($products->count() == 0) {
            go('error');
        }
    } else {
        $products = $page->children()
                          ->listed();
    }

    $products = $products->paginate($perpage);

    return [
      'tag'             => $tag,
      'category'        => $category,
      'lang'            => $lang,
      'products'        => $products,
      'all_products'    => $all_products,
      'pagination'      => $products->pagination(),
      'coverimg_width'  => $coverimg_width,
      'coverimg_height' => $coverimg_height
    ];
};
