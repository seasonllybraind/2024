<?php

$minwidth = site()->productImageratio() == "3:4" ? '900' : '800';
$minheight = site()->productImageratio()->isNotEmpty() ? (site()->productImageratio() == "4:3" ? '600' : '1200') : '800';
$mediaIndex = site()->mediaIndex()->isTrue() ? 'site.index(true).images' : 'model.images';

return [
    'type' => 'image-clip',
    'clip' => [
      'minwidth' => $minwidth,
      'minheight' => $minheight,
      'ratio' => 'fixed'
    ],
    'uploads' => 'image',
    'query' => $mediaIndex,
    'info' => '{{ file.dimensions }} {{ file.niceSize }}',
];
