<?php

include __DIR__ . '/kirby/bootstrap.php';

$kirby = new Kirby([
    'roots' => [
        'index'         => __DIR__,
        'blueprints'    => __DIR__ . '/site/theme/blueprints',
        'collections'   => __DIR__ . '/site/theme/collections',
        'controllers'   => __DIR__ . '/site/theme/controllers',
        'models'        => __DIR__ . '/site/theme/models',
        'snippets'      => __DIR__ . '/site/theme/snippets',
        'templates'     => __DIR__ . '/site/theme/templates'
    ]
]);

echo $kirby->render();