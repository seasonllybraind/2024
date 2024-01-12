<?php

$translations = [

    // reusables
    'reusables.large'                                       => 'Large',
    'reusables.expand'                                      => 'Expand',
    'reusables.left'                                        => 'Left',
    'reusables.center'                                      => 'Center',
    'reusables.right'                                       => 'Right',
    'reusables.fixed'                                       => 'Fixed',
    'reusables.icons'                                       => 'Icons',
    'reusables.button'                                      => 'Button',

    // site
    'site.settings.headline'                                => 'Site Settings',
    // site brand
    'site.settings.brand.headline'                          => 'Brand Settings',
    'site.settings.brand.author'                            => 'Site Author',
    'site.settings.brand.twitter'                           => 'Twitter username',
    'site.settings.brand.twitter.help'                      => 'Used for SEO purpose.',
    'site.settings.brand.email.help'                        => 'This email is used for contact form message receiving and as a contact form sender.',
    'site.settings.brand.favicon.help'                      => 'Must be PNG file. Should be square, max 512px, min 256px.',
    'site.settings.brand.logo.help'                         => 'Main website logo.',
    'site.settings.brand.logo.inverted'                     => 'Logo inverted',
    'site.settings.brand.logo.inverted.help'                => 'Logo for inverted background.',
    'site.settings.brand.logo.mobile.help'                  => 'If empty main logo will be used.',
    'site.settings.brand.logo.mobile.inverted'              => 'Logo mobile inverted',
    'site.settings.brand.logo.mobile.inverted.help'         => 'If empty main logo will be used.',
    'site.settings.brand.logo.height'                       => 'Logo Height',
    'site.settings.brand.logo.mobile.height'                => 'Mobile Logo Height',
    // site navbar
    'site.settings.navbar.headline'                         => 'Navbar',
    'site.settings.navbar.width'                            => 'Navbar width',
    'site.settings.navbar.width.help'                       => 'Default and large has limit, expand has only padding.',
    'site.settings.navbar.menu.position'                    => 'Menu position',
    'site.settings.navbar.menu.position.help'               => 'Align menu center or right.',
    'site.settings.navbar.sticky'                           => 'Sticky navbar',
    'site.settings.navbar.sticky.options.onup'              => 'Show on up',
    'site.settings.navbar.right'                            => 'Right side navigation',
    'site.settings.navbar.right.help'                       => 'Choose right navigation on desktop option.',
    'site.settings.navbar.languagenav'                      => 'Language nav',
    'site.settings.navbar.languagenav.mobile'               => 'Language nav mobile',
    'site.settings.navbar.languagenav.mobile.options.icon'  => 'Navbar icon',
    'site.settings.navbar.languagenav.mobile.options.menu'  => 'Offset menu',
    'site.settings.navbar.searchicon'                       => 'Search icon',
    'site.settings.navbar.searchicon.navbar'                => 'Navbar icon',
    'site.settings.navbar.searchicon.offset'                => 'Offset bar',
    'site.settings.navbar.searchproducts'                   => 'Search products',
    'site.settings.navbar.additionalicon'                   => 'Additional icon',
    'site.settings.navbar.additionalicon.link'              => 'Additional icon Link',

];

foreach ($translations as $key => $value) {
    $return['zero.' . $key] = option('zero.one.t.en.' . $key, $value);
}
return $return;