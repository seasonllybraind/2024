<?php

// Main Less file.
$sourceFile = $kirby->root('assets') . '/app/custom/app.less';
// Final CSS file.
$compiledFile = $kirby->root('assets') . '/app/dist/css/uikit.app.min.css';

// Options
$options = array(
    'compress'=>true,
    'cache_dir' => $kirby->root('cache') . '/less'
);

// Activate library.
require_once $kirby->root('plugins') . '/lessphp/lib/Less/Autoloader.php';
Less_Autoloader::register();

$parser = new Less_Parser($options);

// Compile content in buffer
$parser->parseFile($sourceFile);

// Variables modification
$parser->ModifyVars(
    array(
        # breakpoints
        '@breakpoint-small' => $site->siteBreakpointSmall()->isNotEmpty() ? $site->siteBreakpointSmall() . 'px' : '640px',
        '@breakpoint-medium' => $site->siteBreakpointMedium()->isNotEmpty() ? $site->siteBreakpointMedium() . 'px' : '960px',
        '@breakpoint-large' => $site->siteBreakpointLarge()->isNotEmpty() ? $site->siteBreakpointLarge() . 'px' : '1200px',
        '@breakpoint-xlarge' => $site->siteBreakpointXLarge()->isNotEmpty() ? $site->siteBreakpointXLarge() . 'px' : '1600px',
        # style options
        '@global-shadows' => $site->siteShadows(),
        '@button-box-shadow' => $site->siteShadows()->isTrue() ? $site->siteButtonShadow()->or('@global-medium-box-shadow') : '@global-medium-box-shadow',
        '@card-box-shadow' => $site->siteShadows()->isTrue() ? $site->siteCardShadow()->or('@global-medium-box-shadow') : '@global-medium-box-shadow',
        '@navbar-box-shadow' => $site->siteShadows()->isTrue() ? $site->siteNavbarShadow()->or('@global-medium-box-shadow') : '@global-medium-box-shadow',
        '@global-small-box-shadow' => $site->siteSmallShadow()->isNotEmpty() ? $site->siteSmallShadow() : 'rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px',
        '@global-medium-box-shadow' => $site->siteMediumShadow()->isNotEmpty() ? $site->siteMediumShadow() : 'inset 0 0 0.5px 1px hsla(0, 0%, 100%, 0.075), 0 0 0 1px hsla(0, 0%, 0%, 0.05), 0 0.3px 0.4px hsla(0, 0%, 0%, 0.02), 0 0.9px 1.5px hsla(0, 0%, 0%, 0.045), 0 3.5px 6px hsla(0, 0%, 0%, 0.09)',
        '@global-large-box-shadow' => $site->siteLargeShadow()->isNotEmpty() ? $site->siteLargeShadow() : '0px 10px 15px -3px rgba(0,0,0,0.1) , 0px 4px 6px -2px rgba(0,0,0,0.05)',
        '@global-xlarge-box-shadow' => $site->siteXLargeShadow()->isNotEmpty() ? $site->siteXLargeShadow() : '0px 20px 25px -5px rgba(0,0,0,0.1) , 0px 10px 10px -5px rgba(0,0,0,0.04)',
        '@global-borders-rounded' => $site->siteBorderRadius(),
        # body text
        '@global-font-family' => $site->textFontFamily(),
        '@global-font-size' => $site->textFontSize() . 'px',
        '@global-font-weight' => $site->textFontWeight(),
        '@global-line-height' => $site->textLineHeight()->or('1.6'),
        # headings
        '@global-primary-font-family' => $site->headingFontFamily(),
        '@global-primary-font-weight' => $site->headingFontWeight(),
        '@global-primary-text-transform' => $site->headingTextTransform(),
        '@global-primary-letter-spacing' => $site->headingLetterSpacing()->isNotEmpty() ? $site->headingLetterSpacing() . 'px' : 'inherit',
        # secondary font
        '@global-secondary-font-family' => $site->secondaryFontFamily(),
        '@global-secondary-font-weight' => $site->secondaryFontWeight(),
        '@global-secondary-font-style' => $site->secondaryFontStyle(),
        '@global-secondary-letter-spacing' => $site->secondaryLetterSpacing()->isNotEmpty() ? $site->secondaryLetterSpacing() . 'px' : 'inherit',
        # typography sizes
        '@global-2xlarge-font-size' => $site->baseH1Size()->or('3rem'),
        '@global-xlarge-font-size' => $site->baseH2Size()->or('2rem'),
        '@global-large-font-size' => $site->baseH3Size()->or('1.5rem'),
        '@global-medium-font-size' => $site->baseH4Size()->or('1.25rem'),
        '@global-small-font-size' => $site->baseSmallSize()->or('0.9375rem'),
        # main colors
        '@global-color' => esc($site->textColor()),
        '@global-emphasis-color' => esc($site->textEmphasisColor()),
        '@global-muted-color' => esc($site->textMutedColor()),
        '@global-link-color' => esc($site->textLinkColor()),
        'global-inverse-color' => esc($site->inverseColor()),
        # background colors
        '@global-background' => esc($site->defaultColor()),
        '@global-muted-background' => esc($site->mutedColor()),
        '@global-primary-background' => esc($site->primaryColor()),
        '@global-secondary-background' => esc($site->secondaryColor()),
        # border
        '@global-border' => esc($site->borderColor()),
        '@global-border-width' => $site->borderWidth()->or('1') . 'px',
        # button
        '@global-button-style' => $site->siteButtonStyle(),
        '@global-button-border-style' => $site->siteButtonBorder(),

        '@button-default-background' => $site->customizeButtons()->isTrue() ? $site->defaultButtonBackground()->or('@global-muted-background') : '@global-muted-background',
        '@button-default-color' => $site->customizeButtons()->isTrue() ? $site->defaultButtonColor()->or('@global-emphasis-color') : '@global-emphasis-color',
        '@button-default-hover-background' => $site->customizeButtons()->isTrue() ? $site->defaultButtonHoverBackground()->or('darken(@button-default-background, 5%)') : 'darken(@button-default-background, 5%)',
        '@button-default-hover-color' => $site->customizeButtons()->isTrue() ? $site->defaultButtonHoverColor()->or('@global-emphasis-color') : '@global-emphasis-color',
        '@inverse-button-default-background' => $site->customizeButtons()->isTrue() ? $site->defaultInverseButtonBackground()->or('@inverse-global-primary-background') : '@inverse-global-primary-background',
        '@inverse-button-default-color' => $site->customizeButtons()->isTrue() ? $site->defaultInverseButtonColor()->or('@inverse-global-inverse-color') : '@inverse-global-inverse-color',
        '@inverse-button-default-hover-background' => $site->customizeButtons()->isTrue() ? $site->defaultInverseButtonHoverBackground()->or('darken(@inverse-button-default-background, 5%)') : 'darken(@inverse-button-default-background, 5%)',
        '@inverse-button-default-hover-color' => $site->customizeButtons()->isTrue() ? $site->defaultInverseButtonHoverColor()->or('@inverse-global-inverse-color') : '@inverse-global-inverse-color',

        '@button-primary-background' => $site->customizeButtons()->isTrue() ? $site->primaryButtonBackground()->or('@global-primary-background') : '@global-primary-background',
        '@button-primary-color' => $site->customizeButtons()->isTrue() ? $site->primaryButtonColor()->or('tint(@global-primary-background, 98%)') : 'tint(@global-primary-background, 98%)',
        '@button-primary-hover-background' => $site->customizeButtons()->isTrue() ? $site->primaryButtonHoverBackground()->or('tint(@global-primary-background, 80%)') : 'tint(@global-primary-background, 80%)',
        '@button-primary-hover-color' => $site->customizeButtons()->isTrue() ? $site->primaryButtonHoverColor()->or('darken(@button-primary-background, 30%)') : 'darken(@button-primary-background, 30%)',
        '@inverse-button-primary-background' => $site->customizeButtons()->isTrue() ? $site->primaryInverseButtonBackground()->or('@global-primary-background') : '@global-primary-background',
        '@inverse-button-primary-color' => $site->customizeButtons()->isTrue() ? $site->primaryInverseButtonColor()->or('tint(@global-primary-background, 98%)') : 'tint(@global-primary-background, 98%)',
        '@inverse-button-primary-hover-background' => $site->customizeButtons()->isTrue() ? $site->primaryInverseButtonHoverBackground()->or('tint(@global-primary-background, 80%)') : 'tint(@global-primary-background, 80%)',
        '@inverse-button-primary-hover-color' => $site->customizeButtons()->isTrue() ? $site->primaryInverseButtonHoverColor()->or('darken(@button-primary-background, 30%)') : 'darken(@button-primary-background, 30%)',

        '@button-secondary-background' => $site->customizeButtons()->isTrue() ? $site->secondaryButtonBackground()->or('@global-secondary-background') : '@global-secondary-background',
        '@button-secondary-color' => $site->customizeButtons()->isTrue() ? $site->secondaryButtonColor()->or('tint(@global-secondary-background, 98%)') : 'tint(@global-secondary-background, 98%)',
        '@button-secondary-hover-background' => $site->customizeButtons()->isTrue() ? $site->secondaryButtonHoverBackground()->or('tint(@global-secondary-background, 80%)') : 'tint(@global-secondary-background, 80%)',
        '@button-secondary-hover-color' => $site->customizeButtons()->isTrue() ? $site->secondaryButtonHoverColor()->or('darken(@button-secondary-background, 30%)') : 'darken(@button-secondary-background, 30%)',
        '@inverse-button-secondary-background' => $site->customizeButtons()->isTrue() ? $site->secondaryInverseButtonBackground()->or('@global-secondary-background') : '@global-secondary-background',
        '@inverse-button-secondary-color' => $site->customizeButtons()->isTrue() ? $site->secondaryInverseButtonColor()->or('tint(@global-secondary-background, 98%)') : 'tint(@global-secondary-background, 98%)',
        '@inverse-button-secondary-hover-background' => $site->customizeButtons()->isTrue() ? $site->secondaryInverseButtonHoverBackground()->or('tint(@global-secondary-background, 80%)') : 'tint(@global-secondary-background, 80%)',
        '@inverse-button-secondary-hover-color' => $site->customizeButtons()->isTrue() ? $site->secondaryInverseButtonHoverColor()->or('darken(@button-secondary-background, 30%)') : 'darken(@button-secondary-background, 30%)',

        # navbar
        '@navbar-nav-item-height' => $site->siteNavbarHeight() . 'px',
        '@navbar-background' => esc($site->siteNavbarBackground()->or('@global-background')),
        '@navbar-nav-item-font-weight' => $site->siteNavbarFontWeight()->or('inherit'),
        '@navbar-nav-item-text-transform' => $site->siteNavbarTextTransform()->or('inherit'),
        '@navbar-dropdown-background' => esc($site->siteDropdownBackground()),
        '@dropdown-background' => esc($site->siteDropdownBackground()),
        '@navbar-dropdown-nav-item-color' => esc($site->siteDropdownColor()),
        '@navbar-dropdown-nav-item-hover-color' => esc($site->siteDropdownHoverColor()),
        '@global-navbar-style' => esc($site->siteNavbarStyle()),
        '@navbar-nav-item-font-family' => $site->siteNavbarFont()->or('@global-font-family'),
        '@navbar-nav-item-font-size' => $site->siteNavbarFontsize()->or('@global-font-size'),
        # offcanvas
        '@offcanvas-bar-background' => $site->siteOffcanvasBackground()->or('@global-secondary-background'),
        '@offcanvas-bar-color-mode' => $site->siteOffcanvasColormode()->isTrue() ? 'dark' : 'light',
        '@offcanvas-bar-width' => $site->siteOffcanvasMobilesize()->or('300px'),
        '@offcanvas-bar-width-s' => $site->siteOffcanvasDesktopsize()->or('400px'),
        '@offcanvas-overlay-background-blurred' => $site->siteOffcanvasOverlayBlurred()->isTrue() ? 'true' : 'false'
        )
);

$css = $parser->getCss();


// Update CSS file.
file_put_contents($compiledFile, $css);
