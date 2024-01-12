<?php

// nested menu
$items = $pages->listed();

// only show the menu if items are available
if($items->isNotEmpty()):

?>
  <ul id="mobile-menu" class="uk-nav uk-nav-primary" aria-live="polite"<?php e($site->mobileNav() == "true", ' uk-nav="toggle: .subnav-toggle"') ?>>
    <?php foreach($items as $item): ?>
    <?php $parent = $item->hasListedChildren() && !$item->isHomepage() && $item->disallowSubmenu() != "true"; ?>
    <li class="<?php e($parent, 'uk-parent') ?><?php e($item->isOpen(), ' uk-active') ?>">
      <a href="<?= $item->url() ?>"<?php e($item->newTab()->isTrue(), ' target="_blank"') ?><?php e($parent, ' class="uk-flex-middle uk-flex-between" data-no-swup') ?>>
      <?php if($site->mobileNav() == "true" && $parent): ?>
        <span><?= $item->title()->html() ?></span>
        <span class="subnav-toggle" uk-icon="chevron-left"></span>
      <?php else: ?>
        <?= $item->title()->html() ?>
      <?php endif ?>
      </a>

      <?php

      // get all children for the current menu item
      $children = $item->template() == 'blog' ? $item->children()->listed()->sortBy('date')->flip() : $item->children()->listed();

      // display the submenu if children are available
      
      if(!$item->isHomepage() && $item->disallowSubmenu() != "true" && $item->hasListedChildren()):

      ?>
      
        <ul class="uk-nav-sub">
            <?php foreach($children as $child): ?>
            <li<?php e($child->isOpen(), ' class="uk-active"') ?>>
              <a href="<?= $child->url() ?>"<?php e($child->newTab()->isTrue(), ' target="_blank"') ?>><?php e($child->menuItemIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $child->menuItemIcon() . '"></span>') ?><?= $child->title()->html() ?></a>
              <?php
            
              // get all listed children for the current menu item
              $grandchildren = $child->children()->listed();
              
              if($child->disallowSubmenu() != "true" && $child->hasListedChildren()):
              
              ?>
              <ul>
              <?php foreach($grandchildren as $grandchild): ?>
                <li<?php e($grandchild->isOpen(), ' class="uk-active"') ?>><a href="<?= $grandchild->url() ?>"<?php e($grandchild->newTab()->isTrue(), ' target="_blank"') ?>><?php e($grandchild->menuItemIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $grandchild->menuItemIcon() . '"></span>') ?><?= $grandchild->title()->html() ?></a></li>
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

<?php endif ?>
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