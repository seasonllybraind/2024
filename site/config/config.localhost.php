<?php

return [
    
    // https://getkirby.com/docs/reference/system/options/debug
    'debug' => true,

    // Example on how to override any panel translation
    // 'zero.one.t.en.site.settings.headline' => 'Custom headline',

    // More info on this setings at https://getkirby.com/docs/cookbook/forms/using-mailhog-for-email-testing#what-is-mailhog
    'email' => [
        'transport' => [
          'type' => 'smtp',
          'host' => 'localhost',
          'port' => 1025,
          'security' => false
        ]
    ]
    
    // Add here new config options. Always add comma at the end.

];