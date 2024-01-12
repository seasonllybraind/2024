<?php

$mediaIndex = site()->mediaIndex()->isTrue() ? 'site.index(true).images' : 'model.images';

return [
    'label' => [
        'en' => 'Image',
        'de' => 'Bild',
      ],
    'type' => 'files',
    'uploads' => 'image',
    'query' => $mediaIndex,
    'max' => '1',
    'info' => '{{ file.dimensions }} {{ file.niceSize }}',
    'image' => [
        'ratio' => '2/1',
        'cover' => 'true',
      ],
];