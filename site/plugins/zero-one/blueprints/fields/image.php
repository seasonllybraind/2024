<?php

$mediaIndex = site()->mediaIndex()->isTrue() ? 'site.index(true).images' : 'model.images';

return [
    'type' => 'files',
    'uploads' => 'image',
    'query' => $mediaIndex,
    'info' => '{{ file.dimensions }} {{ file.niceSize }}',
];