<?php

return function ($kirby, $site, $pages, $page) {
    $perpage  = $page->perpage()->int();

    $cover_width = $site->coverWidth()->isNotEmpty() ? $page->coverWidth()->toInt() : '600';
    $cover_height = $site->coverHeight()->isNotEmpty() ? $page->coverHeight()->toInt() : '800';

    $all_projects = $page->children()
                          ->listed();

    $tag = urldecode(param('tag') ?? '');

    $lang = $kirby->languages()->isNotEmpty() ? $kirby->language() : null;
    $lang = $kirby->language()->isDefault() === null;
    $langfilter = function ($child) {
        return kirby()->languages()->isNotEmpty() ? $child->translation(kirby()->language()->code()) : $child;
    };

    if ($tag) {
        $projects = $page->children()
                          ->listed()
                          ->filter($langfilter)
                          ->filterBy('tags', $tag, ',');
        if ($projects->count() == 0) {
            go('error');
        }
    } else {
        $projects = $page->children()
                          ->listed();
    }

    $projects = $projects->paginate($perpage);

    return [
      'tag'          => $tag,
      'lang'         => $lang,
      'projects'     => $projects,
      'all_projects' => $all_projects,
      'pagination'   => $projects->pagination(),
      'cover_width'  => $cover_width,
      'cover_height' => $cover_height
    ];
};
