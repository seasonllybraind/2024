<?php

$minwidth = site()->coverWidth()->isNotEmpty() ? site()->coverWidth()->toInt() : '600';
$minheight = site()->coverHeight()->isNotEmpty() ? site()->coverHeight()->toInt() : '800';
$ratio = site()->coverRatio()->isTrue() ? '' : 'fixed';
$mediaIndex = site()->mediaIndex()->isTrue() ? 'site.index(true).images' : 'model.images';

return [
    'type' => 'image-clip',
    'clip' => [
      'minwidth' => $minwidth,
      'minheight' => $minheight,
      'ratio' => $ratio,
    ],
    'uploads' => 'image',
    'query' => $mediaIndex,
    'info' => '{{ file.dimensions }} {{ file.niceSize }}',
];