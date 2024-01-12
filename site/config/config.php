<?php

return [

    // https://getkirby.com/docs/reference/system/options/panel#custom-panel-css
    'panel' => [
      'css' => 'assets/css/panel.css'
    ],

    // https://getkirby.com/docs/reference/system/options/languages
    'languages' => true,
    // 'languages.detect' => true

    // https://getkirby.com/docs/reference/system/options/smartypants
    'smartypants' => true,

    // Autoresize plugin https://github.com/medienbaecker/kirby-autoresize
    'medienbaecker.autoresize.maxWidth' => 2560,
    'medienbaecker.autoresize.quality' => 90,

    // Commentions plugin https://github.com/sebastiangreger/kirby3-commentions
    'sgkirby.commentions.templatesWithComments' => ['article'],
    'sgkirby.commentions.templatesWithWebmentions' => [''],
    'sgkirby.commentions.hideforms' => false, /* Comment form hide buttom, if true */
    'sgkirby.commentions.expand' => true, /* Webmention form hide buttom, if true */
    'sgkirby.commentions.allowlinks' => true, /* Allow links in comments, if true */
    'sgkirby.commentions.autolinks' => true,  /* Automatically recognize URLs in comments and turn them into links. Has no effect, if allowlinks is false. */
    'sgkirby.commentions.commentfields' => [
      'name' => true,  // include name field and mark as required
      'email'=> true,  // include email as optional field
      'website',       // include optional website field
    ],
    'sgkirby.commentions.secret' => '<YOUR-SECRET>', // A valid secret key must be at least 10 characters long and may NOT include any of the following: & % # + nor a space sign .

    // https://getkirby.com/docs/reference/system/options/thumbs
    // not used anywhere actually
    'thumbs' => [
      'srcsets' => [
        'default' => [
          '300w'  => ['width' => 300, 'quality' => 85],
          '600w'  => ['width' => 600, 'quality' => 85],
          '900w'  => ['width' => 900, 'quality' => 85],
          '1200w' => ['width' => 1200, 'quality' => 85],
          '1800w' => ['width' => 1800, 'quality' => 85]
        ],
        'default_webp' => [
          '300w'  => ['width' => 300, 'quality' => 85, 'format' => 'webp'],
          '600w'  => ['width' => 600, 'quality' => 85, 'format' => 'webp'],
          '900w'  => ['width' => 900, 'quality' => 85, 'format' => 'webp'],
          '1200w' => ['width' => 1200, 'quality' => 85, 'format' => 'webp'],
          '1800w' => ['width' => 1800, 'quality' => 85, 'format' => 'webp']
        ],
        'background' => [
          '600w'  => ['width' => 600, 'quality' => 85],
          '900w'  => ['width' => 900, 'quality' => 85],
          '1200w' => ['width' => 1200, 'quality' => 85],
          '1600w' => ['width' => 1600, 'quality' => 85],
          '1920w' => ['width' => 1920, 'quality' => 85],
          '2200w' => ['width' => 2200, 'quality' => 85],
          '2560w' => ['width' => 2560, 'quality' => 85]
        ],
        'background_webp' => [
          '600w'  => ['width' => 600, 'quality' => 85, 'format' => 'webp'],
          '900w'  => ['width' => 900, 'quality' => 85, 'format' => 'webp'],
          '1200w' => ['width' => 1200, 'quality' => 85, 'format' => 'webp'],
          '1600w' => ['width' => 1600, 'quality' => 85, 'format' => 'webp'],
          '1920w' => ['width' => 1920, 'quality' => 85, 'format' => 'webp'],
          '2200w' => ['width' => 2200, 'quality' => 85, 'format' => 'webp'],
          '2560w' => ['width' => 2560, 'quality' => 85, 'format' => 'webp']
          ]
        ]
    ],

    // Robots plugin https://github.com/bnomei/kirby3-robots-txt
    'bnomei.robots-txt.sitemap' => 'sitemap.xml',
    'bnomei.robots-txt.groups' => [ // array or callback
      '*' => [ // user-agent
          'disallow' => [
              '/kirby/',
              '/site/',
          ],
          'allow' => [
              '/media/',
          ]
      ]
    ],

    // Write custom CSS to file
    'hooks' => [
      'site.update:after' => function($newSite) {
    
        $css = $newSite->customCss()->value();
          if (kirby()->language()->isDefault()) {
            F::write(kirby()->root('assets') . '/css/site.css', $css);
        }
      }
    ],

    // Support for language detect option https://getkirby.com/docs/guide/languages/introduction#automatic-language-detection
    'routes' => [
      [
          'pattern' => '/',
          'action'  => function () {
              $session = kirby()->session();

              if ($session->get('languages.detect', false) === false && option('languages.detect') === true) {
                  $session->set('languages.detect', true);

                  return kirby()
                      ->response()
                      ->redirect(kirby()->detectedLanguage()->url());
              }

              return page();
          }
        ]
    ],

    // Remove update notification for some plugins
    'updates.plugins' => [
      'avoskitchen/sanitizer'         => false,
      'bvdputte/kirby-bettersearch'   => false,
      'hananils/kirby-colors'         => false,
      'kirbyzone/sitemapper'          => false,
      'sylvainjule/code-editor'       => false,
      'zero/zero-one'                 => false
    ]

];
