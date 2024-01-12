<?php if($site->topbar() == "true"): ?>
  <?php snippet('header/navbar/topbar') ?>
<?php endif ?>
<div id="navbar"<?php if($site->sticky()->isNotEmpty()): ?> uk-sticky="<?php if($site->sticky() == "scroll"): ?>show-on-up: true; start: 300; <?php endif ?>animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive:<?php if($page->transparentNavbar()->isEmpty() && $site->sticky()->isNotEmpty() && $page->intendedTemplate()->name() !== "error" && $page->intendedTemplate()->name() !== "search" && $page->intendedTemplate()->name() !== "product"): ?><?php e($site->transparentNavbar() == "true" && $site->sticky()->isNotEmpty(), 'uk-navbar-transparent') ?><?php e($site->transparentNavbar() == "true" && $site->sticky()->isNotEmpty() && $site->navbarInverse() == "true", ' uk-light') ?><?php elseif($page->transparentNavbar() == "transparent" && $site->sticky()->isNotEmpty()): ?> uk-navbar-transparent<?php e($page->navbarInverse() == "true", ' uk-light') ?><?php endif ?>;"<?php endif ?>>
  <div class="uk-navbar-container<?php if($page->transparentNavbar()->isEmpty() && $site->sticky()->isEmpty() && $page->intendedTemplate()->name() !== "error" && $page->intendedTemplate()->name() !== "search" && $page->intendedTemplate()->name() !== "product"): ?><?php e($site->transparentNavbar() == "true" && $site->sticky()->isEmpty(), ' uk-navbar-transparent') ?><?php e($site->transparentNavbar() == "true" && $site->sticky()->isEmpty() && $site->navbarInverse() == "true", ' uk-light') ?><?php elseif($page->transparentNavbar() == "transparent" && $site->sticky()->isEmpty()): ?> uk-navbar-transparent<?php e($page->navbarInverse() == "true", ' uk-light') ?><?php endif ?>" aria-live="polite">
    <div class="uk-container<?php e($site->navbarWidth() == "large", ' uk-container-xlarge') ?><?php e($site->navbarWidth() == "expand", ' uk-container-expand') ?>">
    <nav class="uk-navbar" uk-navbar>
    <?php if($site->menuPosition() == "left" && $site->children()->listed()->isNotEmpty()): ?>
      <!-- offset click -->
      <a class="uk-navbar-toggle tm-menu-animate uk-hidden@m" data-no-swup uk-icon="icon: menu;" uk-toggle="target: #offcanvas"></a>
    <?php endif ?>
      <div class="uk-navbar-left<?php e($site->menuPosition() == "left", ' uk-visible@m') ?>">
      <?php if($site->menuPosition() == "left"): ?>
        <?php if($site->mainMenuBuilder()->toStructure()->isNotEmpty()): ?>
          <?php snippet('menus/menu-builder') ?>
        <?php else: ?>
          <?php snippet('menus/nested-menu') ?>
        <?php endif ?>
      <?php else: ?>
        <?php snippet('header/navbar/logo') ?>
      <?php endif ?>
      </div>

      <?php if($site->menuPosition() == "center"): ?>
      <div class="uk-navbar-center uk-visible@m">
        <?php if($site->mainMenuBuilder()->toStructure()->isNotEmpty()): ?>
          <?php snippet('menus/menu-builder') ?>
        <?php else: ?>
          <?php snippet('menus/nested-menu') ?>
        <?php endif ?>
      </div>
      <?php endif ?>
      <?php if($site->menuPosition() == "left"): ?>
      <div class="uk-navbar-center">
        <?php snippet('header/navbar/logo') ?>
      </div>
      <?php endif ?>
        
      <div class="uk-navbar-right">
      <?php if($site->menuPosition() == "right"): ?>
      <div class="uk-visible@m">
        <?php if($site->mainMenuBuilder()->toStructure()->isNotEmpty()): ?>
          <?php snippet('menus/menu-builder') ?>
        <?php else: ?>
          <?php snippet('menus/nested-menu') ?>
        <?php endif ?>
      </div>
      <?php endif ?>
      <?php if($site->languagenav() == "true"): ?> <!-- language nav -->
      <a class="uk-navbar-item tm-language<?php e($site->languagenavMobile() == "true", ' uk-visible@m') ?>" title="<?= $site->labelLanguageTitle()->html() ?>" data-no-swup href="#language-modal" uk-toggle><?= $kirby->language()->code() ?></a>
      <?php endif ?>
      <?php if($site->snipcartSwitch() == "true" && $site->snipcartApi()->isNotEmpty() && $site->hideCart() != "true"): ?>
        <div class="uk-navbar-item"><a href="#" class="snipcart-checkout" data-no-swup uk-icon="icon: cart"></a><sup class="snipcart-items-count"></sup><?php e($site->hideTotal() != "true", ' <span class="snipcart-total-price uk-text-small uk-visible@s"></span>') ?></div>
      <?php endif ?>
      <?php if($site->rightnav() == "button"): ?>
        <!-- button -->
        <?php if($button = $site->menubuttonlink()->toLinkObject()): ?>
        <div class="uk-navbar-item<?php e($site->children()->listed()->isEmpty(), ' uk-visible', ' uk-visible@m') ?>">
          <a class="uk-button<?php e($site->menubuttonstyle()->isNotEmpty(), ' ' . $site->menubuttonstyle(), ' uk-button-primary') ?>" href="<?= $button->href() ?>"<?php e($button->popup() == "true", ' target="_blank"') ?><?php if($button->text()): ?> title="<?= h($button->title()) ?>" <?php endif ?>><?= h($site->menubuttontext()) ?></a>
        </div>
        <?php endif ?>
      <?php else: ?>
        <!-- iconnav -->
        <?php if($site->searchicon()->isTrue()): ?>
        <div class="uk-navbar-item<?php e($site->searchiconMobile() == "true", ' uk-visible@m') ?>"><a href="#modal-full" data-no-swup uk-search-icon uk-toggle></a></div>
        <?php endif ?>
        <?php if($site->additionalIconToggle()->isTrue()): ?>
        <div class="uk-navbar-item"><a href="<?php if($additionalIconLink = $site->additionalIconLink()->toLinkObject()): ?><?= $additionalIconLink->href() ?>"<?php e($additionalIconLink->popup() == "true", ' target="_blank"') ?><?php if($additionalIconLink->text()): ?> title="<?= h($additionalIconLink->title()) ?>"<?php endif ?><?php endif ?> uk-icon="<?php e($site->additionalIcon()->isNotEmpty(), $site->additionalIcon()) ?>" data-no-swup></a></div>
        <?php endif ?>
        <?php if($site->moreicon()->isNotEmpty()): ?>
        <div class="uk-navbar-item tm-menu-animate<?php e($site->children()->listed()->isEmpty(), ' uk-visible', ' uk-visible@m') ?>"><a href="#" data-no-swup uk-icon="icon: menu" uk-toggle="target: #offcanvas-flip"></a></div>
        <?php endif ?>
      <?php endif ?>
      <?php if($site->menuPosition() != "left" && $site->children()->listed()->isNotEmpty()): ?>
        <!-- offset click -->
        <a class="uk-navbar-toggle tm-menu-animate uk-hidden@m" data-no-swup uk-icon="icon: menu;" uk-toggle="target: #offcanvas"></a>
      <?php endif ?>
      </div>
      </nav>
      </div>
    </div>

    <?php if($site->rightnav() == "icons"): ?>
    <?php if($site->searchicon() == "true"): ?><!-- search modal -->
      <?php snippet('header/navbar/search-modal') ?>
    <?php endif ?>
    <?php if($site->moreicon()->isNotEmpty()): ?>
    <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true"> <!-- offset content -->
        <div class="uk-offcanvas-bar">
            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <?= $site->moreicon()->kt() ?>
        </div>
    </div>
    <?php endif ?>
    <?php endif ?>

    <?php if($site->languagenav() == "true"): ?>
      <?php snippet('header/navbar/language-modal') ?>
    <?php endif ?>

  </div>  