<?php

$mediaIndex = site()->mediaIndex()->isTrue() ? 'site.index(true).videos' : 'model.videos';

return [
    'type' => 'files',
    'uploads' => 'video',
    'query' => $mediaIndex,
    'info' => '{{ file.niceSize }}',
];