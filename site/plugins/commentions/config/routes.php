<?php

namespace sgkirby\Commentions;

return [

    [
        'pattern' => option('sgkirby.commentions.endpoint', 'webmention-endpoint'),
        'method'  => 'GET|POST',
        'action'  => function () {
            return Endpoint::route();
        }
    ],
    [
        'pattern' => 'commentions-processqueue',
        'action'  => function () {
            return Cron::route();
        }
    ],
    [
        'pattern' => 'commentions-migrationassistant',
        'method'  => 'GET|POST',
        'action'  => function () {
            return Migration::route();
        }
    ]

];
