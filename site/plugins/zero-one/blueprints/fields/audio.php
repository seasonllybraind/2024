<?php

$mediaIndex = site()->mediaIndex()->isTrue() ? 'site.index(true).audio' : 'model.audio';

return [
    'type' => 'files',
    'uploads' => 'audio',
    'query' => $mediaIndex,
    'info' => '{{ file.niceSize }}',
];