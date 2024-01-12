<?php

$translations = [

    // reusables
    'reusables.large'                                       => 'Grande',
    'reusables.expand'                                      => 'Étendu',
    'reusables.left'                                        => 'Gauche',
    'reusables.center'                                      => 'Centre',
    'reusables.right'                                       => 'Droite',
    'reusables.fixed'                                       => 'Fixe',
    'reusables.icons'                                       => 'Icônes',
    'reusables.button'                                      => 'Bouton',

    // site
    'site.settings.headline'                                => 'Paramètres du site',
    // site brand
    'site.settings.brand.headline'                          => 'Paramètres de la marque',
    'site.settings.brand.author'                            => "Site de l'auteur",
    'site.settings.brand.twitter'                           => 'Nom sur Twitter',
    'site.settings.brand.twitter.help'                      => 'Utilisé à des fins de référencement.',
    'site.settings.brand.email.help'                        => 'Cet e-mail est utilisé pour la réception des messages du formulaire de contact et comme expéditeur du formulaire de contact.',
    'site.settings.brand.favicon.help'                      => 'Doit être un fichier PNG. Doit être carré, max 512px, min 256px.',
    'site.settings.brand.logo.help'                         => 'Logo principal du site.',
    'site.settings.brand.logo.inverted'                     => 'Logo inversé',
    'site.settings.brand.logo.inverted.help'                => 'Logo pour arrière-plan inversé.',
    'site.settings.brand.logo.mobile.help'                  => 'Si vide, le logo principal sera utilisé.',
    'site.settings.brand.logo.mobile.inverted'              => 'Logo mobile inversé',
    'site.settings.brand.logo.mobile.inverted.help'         => 'Si vide, le logo principal sera utilisé.',
    'site.settings.brand.logo.height'                       => 'Hauteur du logo',
    'site.settings.brand.logo.mobile.height'                => 'Hauteur du logo mobile',
    // site navbar
    'site.settings.navbar.headline'                         => 'Barre de navigation',
    'site.settings.navbar.width'                            => 'Largeur de la barre de navigation',
    'site.settings.navbar.width.help'                       => "Par défaut et grand a une limite, développer n'a qu'une marge intérieure.",
    'site.settings.navbar.menu.position'                    => 'Position du menu',
    'site.settings.navbar.menu.position.help'               => 'Aligner le menu au centre ou à droite.',
    'site.settings.navbar.sticky'                           => 'Barre de navigation "sticky"',
    'site.settings.navbar.sticky.options.onup'              => 'Afficher en haut',
    'site.settings.navbar.right'                            => 'Navigation à droite',
    'site.settings.navbar.right.help'                       => "Choisissez l'option de navigation droite sur ordinateur.",
    'site.settings.navbar.languagenav'                      => 'Navigation par langue',
    'site.settings.navbar.languagenav.mobile'               => 'Nav par langue sur mobile',
    'site.settings.navbar.languagenav.mobile.options.icon'  => 'Icône de navigation',
    'site.settings.navbar.languagenav.mobile.options.menu'  => 'Menu décalé',
    'site.settings.navbar.searchicon'                       => 'Icône de recherche',
    'site.settings.navbar.searchicon.navbar'                => 'Icône barre de navigation',
    'site.settings.navbar.searchicon.offset'                => 'Barre de décalage',
    'site.settings.navbar.searchproducts'                   => 'Recherche de produits',
    'site.settings.navbar.additionalicon'                   => 'Icône supplémentaire',
    'site.settings.navbar.additionalicon.link'              => 'Icône supplémentaire Lien',


];

foreach ($translations as $key => $value) {
    $return['zero.' . $key] = option('zero.one.t.fr.' . $key, $value);
}
return $return;