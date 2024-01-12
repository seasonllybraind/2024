<?php

// main menu
$items = $site->mainMenuBuilder()->toStructure();

?>
<ul class="uk-navbar-nav">
  <?php foreach ($items as $item) : ?>

    <?php if($item->linkType() == "page" && $pageLink = $item->pageLink()->toPage()) : ?>
    <li<?php e($pageLink->isOpen() && $item->anchor()->isEmpty(), ' class="uk-active"') ?>><a href="<?php e($pageLink->isOpen() && $item->anchor()->isNotEmpty(), '#' . $item->anchor(), ($item->anchor()->isNotEmpty() ? $pageLink->url() . '#' . $item->anchor() : $pageLink->url())) ?>"<?php e($item->newTab()->isTrue(), ' target="_blank"') ?><?php e($pageLink->isOpen() && $item->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>><?php e($item->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $item->icon() . '"></span>') ?><?= $item->linkTitle()->or($pageLink->title()) ?>
    <?php elseif ($item->linkType() == "external" && $item->externalLink()->isNotEmpty()) : ?>
    <li><a href="<?= $item->externalLink() ?><?php e($item->anchor()->isNotEmpty(), '#' . $item->anchor()) ?>"<?php e($item->newTab()->isTrue(), ' target="_blank"') ?>><?php e($item->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $item->icon() . '"></span>') ?><?= $item->linkTitle()->or('Add link title') ?>
    <?php endif ?>

    <?php $subItems = $item->subMenu()->toStructure(); ?>
    <?php 
    // sub menu
    if ($item->hasSubmenu()->isTrue() && $subItems->isNotempty()) : ?>
    <span uk-navbar-parent-icon></span></a>
    <div class="uk-navbar-dropdown<?php e($item->megaMenu()->isTrue() && (2 <= $subItems->count()) && ($subItems->count() <= 4), ' uk-navbar-dropdown-width-' . ($item->megaMenuWidth()->isNotEmpty() ? $item->megaMenuWidth() : $subItems->count()), ($item->megaMenu()->isTrue() && $item->megaMenuWidth()->isNotEmpty() ? ' uk-navbar-dropdown-width-' . $item->megaMenuWidth() : null)) ?>" uk-dropdown="animation: uk-animation-slide-bottom-small; duration: 300; offset: 0; animate-out: true;">
    <?php if($item->megaMenu()->isTrue() && $item->megaMenuBackground()->isTrue()): ?>
      <?php if($img = $item->megaMenuBackgroundImage()->toFile()): ?>
        <div class="uk-position-cover<?= ' ' . $item->megaMenuBackgroundImagePosition() ?><?= ' ' . $item->megaMenuBackgroundImageSize() ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-blend-mode: overlay; background-repeat:<?= $item->megaMenuBackgroundImageRepeat() ?>" uk-img="loading: eager"></div>
        <?php endif ?>
        <div class="uk-position-cover" style="<?php if($item->megaMenuBackgroundGradientOverlay()->isTrue()): ?>background-image: linear-gradient(<?php e($item->megaMenuBackgroundGradientTransition()->isNotEmpty(), $item->megaMenuBackgroundGradientTransition() . ', ') ?><?= $item->megaMenuBackgroundOverlayColor() ?>, <?= $item->megaMenuBackgroundOverlayColor2() ?>)<?php else: ?>background-color: <?= $item->megaMenuBackgroundOverlayColor() ?><?php endif ?>; background-blend-mode: overlay;"></div>
      <?php endif ?>
      <?php if($item->megaMenu()->isTrue() && (2 <= $subItems->count()) && ($subItems->count() <= 4)): ?>
          <div class="<?php e($item->megaMenuBackground()->isTrue(), 'uk-position-relative ') ?>uk-drop-grid uk-child-width-1-<?php e($item->megaMenuItemWidth()->isNotEmpty(), $item->megaMenuItemWidth(), $subItems->count()) ?>" uk-grid>
            <?php foreach($subItems as $subItem): ?>
            <div>
                <ul class="uk-nav uk-navbar-dropdown-nav">
                  <?php if($subItem->linkType() == "page" && $subPageLink = $subItem->pageLink()->toPage()) : ?>
                  <li class="uk-nav-header<?php e($subPageLink->isOpen() && $subItem->anchor()->isEmpty(), ' uk-active') ?>"><a href="<?php e($subPageLink->isOpen() && $subItem->anchor()->isNotEmpty(), '#' . $subItem->anchor(), ($subItem->anchor()->isNotEmpty() ? $subPageLink->url() . '#' . $subItem->anchor() : $subPageLink->url())) ?>"<?php e($subItem->newTab()->isTrue(), ' target="_blank"') ?><?php e($subPageLink->isOpen() && $subItem->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>><?php e($subItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subItem->icon() . '"></span>') ?><?= $subItem->linkTitle()->or($subPageLink->title()) ?></a></li>
                  <?php elseif ($subItem->linkType() == "external" && $subItem->externalLink()->isNotEmpty()) : ?>
                  <li class="uk-nav-header"><a href="<?= $subItem->externalLink() ?><?php e($subItem->anchor()->isNotEmpty(), '#' . $subItem->anchor()) ?>"<?php e($subItem->newTab()->isTrue(), ' target="_blank"') ?>><?php e($subItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subItem->icon() . '"></span>') ?><?= $subItem->linkTitle()->or('Add link title') ?></a></li>
                  <?php endif ?>
                  <li class="uk-nav-divider"></li>
                  
                  <?php $subSubItems = $subItem->subMenu()->toStructure(); ?>
                  <?php foreach($subSubItems as $subSubItem): ?>
                    <?php if($subSubItem->linkType() == "page" && $subSubPageLink = $subSubItem->pageLink()->toPage()) : ?>
                    <li<?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isEmpty(), ' class="uk-active"') ?>><a href="<?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isNotEmpty(), '#' . $subSubItem->anchor(), ($subSubItem->anchor()->isNotEmpty() ? $subSubPageLink->url() . '#' . $subSubItem->anchor() : $subSubPageLink->url())) ?>"<?php e($subSubItem->newTab()->isTrue(), ' target="_blank"') ?><?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>><?php e($subSubItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subSubItem->icon() . '"></span>') ?><?= $subSubItem->linkTitle()->or($subSubPageLink->title()) ?></a></li>
                    <?php elseif ($subSubItem->linkType() == "external" && $subSubItem->externalLink()->isNotEmpty()) : ?>
                    <li><a href="<?= $subSubItem->externalLink() ?><?php e($subSubItem->anchor()->isNotEmpty(), '#' . $subSubItem->anchor()) ?>"<?php e($subSubItem->newTab()->isTrue(), ' target="_blank"') ?>><?php e($subSubItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subSubItem->icon() . '"></span>') ?><?= $subSubItem->linkTitle()->or('Add link title') ?></a></li>
                    <?php endif ?>
                  <?php endforeach ?>
                </ul>
            </div>
            <?php endforeach ?>
          </div>
        <?php else: ?>
        <ul class="<?php e($item->megaMenu()->isTrue() && $item->megaMenuBackground()->isTrue(), 'uk-position-relative ') ?>uk-nav uk-navbar-dropdown-nav">
        <?php foreach ($subItems as $subItem) : ?>
            <?php if($subItem->linkType() == "page" && $subPageLink = $subItem->pageLink()->toPage()) : ?>
            <li<?php e($subPageLink->isOpen() && $subItem->anchor()->isEmpty(), ' class="uk-active"') ?>><a href="<?php e($subPageLink->isOpen() && $subItem->anchor()->isNotEmpty(), '#' . $subItem->anchor(), ($subItem->anchor()->isNotEmpty() ? $subPageLink->url() . '#' . $subItem->anchor() : $subPageLink->url())) ?>"<?php e($subItem->newTab()->isTrue(), ' target="_blank"') ?><?php e($subPageLink->isOpen() && $subItem->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>><?php e($subItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subItem->icon() . '"></span>') ?><?= $subItem->linkTitle()->or($subPageLink->title()) ?>
            <?php elseif ($subItem->linkType() == "external" && $subItem->externalLink()->isNotEmpty()) : ?>
            <li><a href="<?= $subItem->externalLink() ?><?php e($subItem->anchor()->isNotEmpty(), '#' . $subItem->anchor()) ?>"<?php e($subItem->newTab()->isTrue(), ' target="_blank"') ?>><?php e($subItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subItem->icon() . '"></span>') ?><?= $subItem->linkTitle()->or('Add link title') ?>
            <?php endif ?>

            <?php $subSubItems = $subItem->subMenu()->toStructure(); ?>
            <?php 
            // sub menu
            if ($subItem->hasSubmenu()->isTrue() && $subSubItems->isNotempty()) : ?>
            <span class="uk-float-right" uk-icon="icon: chevron-right"></span></a>
            <div class="uk-navbar-dropdown" uk-dropdown="animation: uk-animation-slide-bottom-small; duration: 350; pos: right-top; offset: 20; animate-out: true">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                <?php foreach($subSubItems as $subSubItem): ?>
                    <?php if($subSubItem->linkType() == "page" && $subSubPageLink = $subSubItem->pageLink()->toPage()) : ?>
                    <li<?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isEmpty(), ' class="uk-active"') ?>><a href="<?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isNotEmpty(), '#' . $subSubItem->anchor(), ($subSubItem->anchor()->isNotEmpty() ? $subSubPageLink->url() . '#' . $subSubItem->anchor() : $subSubPageLink->url())) ?>"<?php e($subSubItem->newTab()->isTrue(), ' target="_blank"') ?><?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>><?php e($subSubItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subSubItem->icon() . '"></span>') ?><?= $subSubItem->linkTitle()->or($subSubPageLink->title()) ?></a></li>
                    <?php elseif ($subSubItem->linkType() == "external" && $subSubItem->externalLink()->isNotEmpty()) : ?>
                    <li><a href="<?= $subSubItem->externalLink() ?><?php e($subSubItem->anchor()->isNotEmpty(), '#' . $subSubItem->anchor()) ?>"<?php e($subSubItem->newTab()->isTrue(), ' target="_blank"') ?>><?php e($subSubItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subSubItem->icon() . '"></span>') ?><?= $subSubItem->linkTitle()->or('Add link title') ?></a></li>
                    <?php endif ?>
                <?php endforeach ?>
                </ul>
            </div>
            <?php else: ?>
            </a>
            <?php endif ?>
            </li>
        <?php endforeach ?>
        </ul>
    <?php endif ?>
    </div>
    <?php else: ?>
    </a>
    <?php endif ?>
    </li>
  <?php endforeach ?>
</ul>