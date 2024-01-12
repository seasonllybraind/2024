<?php

// nested menu
$items = $site->mainMenuBuilder()->toStructure();

?>
  <ul id="mobile-menu" class="uk-nav uk-nav-primary" aria-live="polite"<?php e($site->mobileNav() == "true", ' uk-nav="toggle: .subnav-toggle"') ?>>
    <?php foreach($items as $item): ?>
    <?php $parent = $item->hasSubmenu()->isTrue() && $item->subMenu()->isNotEmpty(); ?>
    <?php if($item->linkType() == "page" && $pageLink = $item->pageLink()->toPage()) : ?>
    <li class="<?php e($parent, 'uk-parent') ?><?php e($pageLink->isOpen() && $item->anchor()->isEmpty(), ' uk-active') ?>">
      <a href="<?php e($pageLink->isOpen() && $item->anchor()->isNotEmpty(), '#' . $item->anchor(), ($item->anchor()->isNotEmpty() ? $pageLink->url() . '#' . $item->anchor() : $pageLink->url())) ?>"<?php e($item->newTab()->isTrue(), ' target="_blank"') ?><?php e($parent, ' class="uk-flex-middle uk-flex-between" data-no-swup') ?><?php e($pageLink->isOpen() && $item->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>>
      <?php if($site->mobileNav() == "true" && $parent): ?>
        <span><?= $item->linkTitle()->or($pageLink->title()) ?></span>
        <span class="subnav-toggle" uk-icon="chevron-left"></span>
      <?php else: ?>
        <?= $item->linkTitle()->or($pageLink->title()) ?>
      <?php endif ?>
      </a>
    <?php elseif ($item->linkType() == "external" && $item->externalLink()->isNotEmpty()) : ?>
    <li<?php e($parent, ' class="uk-parent"') ?>>
      <a href="<?= $item->externalLink() ?><?php e($item->anchor()->isNotEmpty(), '#' . $item->anchor()) ?>"<?php e($item->newTab()->isTrue(), ' target="_blank"') ?><?php e($parent, ' class="uk-flex-middle uk-flex-between" data-no-swup') ?>>
      <?php if($site->mobileNav() == "true" && $parent): ?>
        <span><?= $item->linkTitle()->or('Add link title') ?></span>
        <span class="subnav-toggle" uk-icon="chevron-left"></span>
      <?php else: ?>
        <?= $item->linkTitle()->or('Add link title') ?>
      <?php endif ?>
      </a>
    <?php endif ?>
    
    <?php $subItems = $item->subMenu()->toStructure(); ?>
    <?php 
    // sub menu
    if ($item->hasSubmenu()->isTrue() && $subItems->isNotempty()) : ?>
      
        <ul class="uk-nav-sub">
            <?php foreach($subItems as $subItem): ?>
            <?php if($subItem->linkType() == "page" && $subPageLink = $subItem->pageLink()->toPage()) : ?>
            <li<?php e($subPageLink->isOpen() && $subItem->anchor()->isEmpty(), ' class="uk-active"') ?>>
              <a href="<?php e($subPageLink->isOpen() && $subItem->anchor()->isNotEmpty(), '#' . $subItem->anchor(), ($subItem->anchor()->isNotEmpty() ? $subPageLink->url() . '#' . $subItem->anchor() : $subPageLink->url())) ?>"<?php e($subItem->newTab()->isTrue(), ' target="_blank"') ?><?php e($subPageLink->isOpen() && $subItem->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>><?php e($subItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subItem->icon() . '"></span>') ?><?= $subItem->linkTitle()->or($subPageLink->title()) ?></a>
            <?php elseif ($subItem->linkType() == "external" && $subItem->externalLink()->isNotEmpty()) : ?>
            <li>
              <a href="<?= $subItem->externalLink() ?><?php e($subItem->anchor()->isNotEmpty(), '#' . $subItem->anchor()) ?>"<?php e($subItem->newTab()->isTrue(), ' target="_blank"') ?>><?php e($subItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subItem->icon() . '"></span>') ?><?= $subItem->linkTitle()->or('Add link title') ?></a>
            <?php endif ?>
            
            <?php $subSubItems = $subItem->subMenu()->toStructure(); ?>
            <?php 
            // sub menu
            if ($subItem->hasSubmenu()->isTrue() && $subSubItems->isNotempty()) : ?>
              <ul>
              <?php foreach($subSubItems as $subSubItem): ?>
                <?php if($subSubItem->linkType() == "page" && $subSubPageLink = $subSubItem->pageLink()->toPage()) : ?>
                <li<?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isEmpty(), ' class="uk-active"') ?>><a href="<?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isNotEmpty(), '#' . $subSubItem->anchor(), ($subSubItem->anchor()->isNotEmpty() ? $subSubPageLink->url() . '#' . $subSubItem->anchor() : $subSubPageLink->url())) ?>"<?php e($subSubItem->newTab()->isTrue(), ' target="_blank"') ?><?php e($subSubPageLink->isOpen() && $subSubItem->anchor()->isNotEmpty(), ' data-no-swup uk-scroll') ?>><?php e($subSubItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subSubItem->icon() . '"></span>') ?><?= $subSubItem->linkTitle()->or($subSubPageLink->title()) ?></a></li>
                <?php elseif ($subSubItem->linkType() == "external" && $subSubItem->externalLink()->isNotEmpty()) : ?>
                <li><a href="<?= $subSubItem->externalLink() ?><?php e($subSubItem->anchor()->isNotEmpty(), '#' . $subSubItem->anchor()) ?>"<?php e($subSubItem->newTab()->isTrue(), ' target="_blank"') ?>><?php e($subSubItem->icon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $subSubItem->icon() . '"></span>') ?><?= $subSubItem->linkTitle()->or('Add link title') ?></a></li>
                <?php endif ?>
              <?php endforeach ?>
              </ul>
              <?php endif ?>
            </li>
            <?php endforeach ?>
        </ul>

      <?php endif ?>

    </li>
    <?php endforeach ?>
    <?php $contact = $site->children()->findBy('template', 'contact'); ?>
    <?php if($button = $site->menubuttonlink()->toPage()): ?>
    <li>
      <a href="<?= $button->url() ?>"><?= h($site->menubuttontext()) ?></a>
    </li>
    <?php else: ?>
    <?php if($contact && !$contact->isListed()): ?>
    <li<?php e($contact->isOpen(), ' class="uk-active"') ?>>
      <a href="<?= $contact->url() ?>"><?= $contact->title() ?></a>
    </li>
    <?php endif ?>
    <?php endif ?>
  </ul>
<?php if($site->languagenav() == "true" && $site->languagenavMobile() == "true"): ?> <!-- language nav -->
  <hr>
  <?php if($kirby->languages()->isNotEmpty()): ?>
  <ul class="uk-nav uk-nav-default">
  <?php foreach($kirby->languages() as $language): ?>
    <li<?php e($kirby->language() == $language, ' class="uk-active"') ?>>
      <a href="<?= $page->url($language->code()) ?>" hreflang="<?= $language->code() ?>">
      <?= $language->name() ?>
      </a>
    </li>
  <?php endforeach ?>
  </ul>
  <?php endif ?>
<?php endif ?>