<?php

return [

    // https://getkirby.com/docs/reference/system/options/debug
    'debug' => false,

    
    /* https://getkirby.com/docs/reference/system/options/email */
    'email' => [
        'transport' => [
          'type' => 'smtp',
          'host' => 'web.lifecorporate.com',
          'port' => 465,
          'security' => true
        ]
      ]

    // Add here new config options. Always add comma at the end.

    /* https://getkirby.com/docs/reference/system/options/cache 
    'cache' => [
        'pages' => [
            'active' => true
        ]
    ],
      */

    /* https://getkirby.com/docs/reference/system/options/panel
    'panel' =>[
        'install' => true
    ],
    */
    
];