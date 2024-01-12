<?php

// nested menu
$items = $pages->listed();

// only show the menu if items are available
if($items->isNotEmpty()):

?>
  <ul class="uk-navbar-nav">
    <?php foreach($items as $item): ?>
    <li<?php e($item->isOpen(), ' class="uk-active"') ?>>
      <a href="<?= $item->url() ?>"<?php e($item->newTab()->isTrue(), ' target="_blank"') ?>><?php e($item->menuItemIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $item->menuItemIcon() . '"></span>') ?><?= $item->title()->html() ?>
      <?php

        // get all children for the current menu item, and exclude some
        $children = $item->template() == 'blog' ? $item->children()->listed()->sortBy('date')->flip() : $item->children()->listed();

        // display the submenu if children are available
        
        if(!$item->isHomepage() && $item->disallowSubmenu() != "true" && $item->hasListedChildren()):

      ?>
       <span uk-navbar-parent-icon></span></a>
      <div class="uk-navbar-dropdown<?php e($item->megaMenu()->isTrue() && (2 <= $children->count()) && ($children->count() <= 4), ' uk-navbar-dropdown-width-' . ($item->megaMenuWidth()->isNotEmpty() ? $item->megaMenuWidth() : $children->count()), ($item->megaMenu()->isTrue() && $item->megaMenuWidth()->isNotEmpty() ? ' uk-navbar-dropdown-width-' . $item->megaMenuWidth() : null)) ?>" uk-dropdown="animation: uk-animation-slide-top-small; duration: 300; offset: 0; animate-out: true;">
      <?php if($item->megaMenu()->isTrue() && $item->megaMenuBackground()->isTrue()): ?>
        <?php if($img = $item->megaMenuBackgroundImage()->toFile()): ?>
        <div class="uk-position-cover<?= ' ' . $item->megaMenuBackgroundImagePosition() ?><?= ' ' . $item->megaMenuBackgroundImageSize() ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-blend-mode: overlay; background-repeat:<?= $item->megaMenuBackgroundImageRepeat() ?>" uk-img="loading: eager"></div>
        <?php endif ?>
        <div class="uk-position-cover" style="<?php if($item->megaMenuBackgroundGradientOverlay()->isTrue()): ?>background-image: linear-gradient(<?php e($item->megaMenuBackgroundGradientTransition()->isNotEmpty(), $item->megaMenuBackgroundGradientTransition() . ', ') ?><?= $item->megaMenuBackgroundOverlayColor() ?>, <?= $item->megaMenuBackgroundOverlayColor2() ?>)<?php else: ?>background-color: <?= $item->megaMenuBackgroundOverlayColor() ?><?php endif ?>; background-blend-mode: overlay;"></div>
      <?php endif ?>
      <?php if($item->megaMenu()->isTrue() && (2 <= $children->count()) && ($children->count() <= 4)): ?>
          <div class="<?php e($item->megaMenuBackground()->isTrue(), 'uk-position-relative ') ?>uk-drop-grid uk-child-width-1-<?php e($item->megaMenuItemWidth()->isNotEmpty(), $item->megaMenuItemWidth(), $children->count()) ?>" uk-grid>
            <?php foreach($children as $child): ?>
            <div>
                <ul class="uk-nav uk-navbar-dropdown-nav">
                  <li class="uk-nav-header<?php e($child->isOpen(), ' uk-active') ?>"><a href="<?= $child->url() ?>"<?php e($child->newTab()->isTrue(), ' target="_blank"') ?>><?php e($child->menuItemIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $child->menuItemIcon() . '"></span>') ?><?= $child->title()->html() ?></a></li>
                  <li class="uk-nav-divider"></li>
                  <?php
            
                    // get all listed children for the current menu item
                    $grandchildren = $child->children()->listed();
                    
                    if($child->disallowSubmenu() != "true" && $child->hasListedChildren()):
                  
                  ?>
                  <?php foreach($grandchildren as $grandchild): ?>
                    <li<?php e($grandchild->isOpen(), ' class="uk-active"') ?>><a href="<?= $grandchild->url() ?>"<?php e($grandchild->newTab()->isTrue(), ' target="_blank"') ?>><?php e($grandchild->menuItemIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $grandchild->menuItemIcon() . '"></span>') ?><?= $grandchild->title()->html() ?></a></li>
                  <?php endforeach ?>
                  <?php endif ?>
                </ul>
            </div>
            <?php endforeach ?>
          </div>
        <?php else: ?>
        <ul class="<?php e($item->megaMenu()->isTrue() && $item->megaMenuBackground()->isTrue(), 'uk-position-relative ') ?>uk-nav uk-navbar-dropdown-nav<?php e($item->megaMenu()->isTrue() && $item->megaMenuWidth()->isNotEmpty(), ' uk-width-1-' . $item->megaMenuWidth()) ?>">
          <?php foreach($children as $child): ?>
          <li<?php e($child->isOpen(), ' class="uk-active"') ?>>
            <a href="<?= $child->url() ?>"<?php e($child->newTab()->isTrue(), ' target="_blank"') ?>><?php e($child->menuItemIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $child->menuItemIcon() . '"></span>') ?><?= $child->title()->html() ?>
            <?php
            
              // get all listed children for the current menu item
              $grandchildren = $child->children()->listed();
              
              if($child->disallowSubmenu() != "true" && $child->hasListedChildren()):
            
            ?>
            <span class="uk-float-right" uk-icon="icon: chevron-right"></span></a>
          <div class="uk-navbar-dropdown" uk-dropdown="animation: uk-animation-slide-bottom-small; duration: 350; pos: right-top; offset: 20; animate-out: true;">
            <ul class="uk-nav uk-navbar-dropdown-nav">
            <?php foreach($grandchildren as $grandchild): ?>
              <li<?php e($grandchild->isOpen(), ' class="uk-active"') ?>><a href="<?= $grandchild->url() ?>"<?php e($grandchild->newTab()->isTrue(), ' target="_blank"') ?>><?php e($grandchild->menuItemIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="' . $grandchild->menuItemIcon() . '"></span>') ?><?= $grandchild->title()->html() ?></a></li>
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
<?php endif ?>

