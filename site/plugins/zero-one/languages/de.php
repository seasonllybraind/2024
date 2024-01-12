<?php

$translations = [

    // reusables
    'reusables.large'                                       => 'Große',
    'reusables.expand'                                      => 'Erweitern',
    'reusables.left'                                        => 'Links',
    'reusables.center'                                      => 'Mitte',
    'reusables.right'                                       => 'Recht',
    'reusables.fixed'                                       => 'Fest',
    'reusables.icons'                                       => 'Symbole',
    'reusables.button'                                      => 'Taste',

    // site
    'site.settings.headline'                                => 'Seiteneinstellungen',
    // site brand
    'site.settings.brand.headline'                          => 'Markeneinstellungen',
    'site.settings.brand.author'                            => 'Site-Autor',
    'site.settings.brand.twitter'                           => 'Twitter Benutzername',
    'site.settings.brand.twitter.help'                      => 'Wird für SEO-Zwecke verwendet.',
    'site.settings.brand.email.help'                        => 'Diese E-Mail wird zum Empfangen von Kontaktformularnachrichten und als Absender von Kontaktformularen verwendet.',
    'site.settings.brand.favicon.help'                      => 'Muss eine PNG-Datei sein. Sollte quadratisch sein, max. 512px, min. 256px.',
    'site.settings.brand.logo.help'                         => 'Hauptwebsite-Logo.',
    'site.settings.brand.logo.inverted'                     => 'Logo invertiert',
    'site.settings.brand.logo.inverted.help'                => 'Logo für invertierten Hintergrund.',
    'site.settings.brand.logo.mobile.help'                  => 'Wenn leer, wird das Hauptlogo verwendet.',
    'site.settings.brand.logo.mobile.inverted'              => 'Logo mobile invertiert',
    'site.settings.brand.logo.mobile.inverted.help'         => 'Wenn leer, wird das Hauptlogo verwendet.',
    'site.settings.brand.logo.height'                       => 'Logo Höhe',
    'site.settings.brand.logo.mobile.height'                => 'Mobile Logo Höhe',
    // site navbar
    'site.settings.navbar.headline'                         => 'Navbar',
    'site.settings.navbar.width'                            => 'Navbar Breite',
    'site.settings.navbar.width.help'                       => 'Standard und große hat Limit, erweitern Sie hat nur Polsterung.',
    'site.settings.navbar.menu.position'                    => 'Menüposition',
    'site.settings.navbar.menu.position.help'               => 'Menü Mitte oder rechts ausrichten.',
    'site.settings.navbar.sticky'                           => 'Klebrige Navigationsleiste',
    'site.settings.navbar.sticky.options.onup'              => 'Zeigen Sie auf',
    'site.settings.navbar.right'                            => 'Navigation auf der rechten Seite',
    'site.settings.navbar.right.help'                       => 'Wählen Sie die richtige Navigation auf dem Desktop.',
    'site.settings.navbar.languagenav'                      => 'Sprachnavigation',
    'site.settings.navbar.languagenav.mobile'               => 'Sprachnavigation mobil',
    'site.settings.navbar.languagenav.mobile.options.icon'  => 'Navbar-Symbol',
    'site.settings.navbar.languagenav.mobile.options.menu'  => 'Offset-Menü',
    'site.settings.navbar.searchicon'                       => 'Suchsymbol',
    'site.settings.navbar.searchicon.navbar'                => 'Navbar-Symbol',
    'site.settings.navbar.searchicon.offset'                => 'Versetzter Balken',
    'site.settings.navbar.searchproducts'                   => 'Produktsuche',
    'site.settings.navbar.additionalicon'                   => 'Zusätzliches Symbol',
    'site.settings.navbar.additionalicon.link'              => 'Zusätzliches Symbol Link',


];

foreach ($translations as $key => $value) {
    $return['zero.' . $key] = option('zero.one.t.de.' . $key, $value);
}
return $return;