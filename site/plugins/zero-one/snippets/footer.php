<?php if(!$page->hideFooter()->isTrue()): ?>
<?php if($site->footerBuilder() == "layout-builder"): ?>
<footer>
<?php foreach ($site->layout()->toLayouts() as $layout): ?>
<?php snippet('layout/layout', ['layout' => $layout]) ?>
<?php endforeach ?>
</footer>
<?php else: ?>
<?php if($site->footerStyle()->isNotEmpty()): ?>
<?php if($site->footerColor() == "image" && ($img = $site->backgroundImage()->toFile())): ?>
<footer id="footer" class="<?php if($site->backgroundImagePosition()): ?><?= $site->backgroundImagePosition() ?><?php endif ?><?php if($site->backgroundImageSize()): ?> <?= $site->backgroundImageSize() ?><?php endif ?><?php if($site->footerTextColor()): ?> <?= $site->footerTextColor() ?><?php endif ?>" style="background-image: url(<?= $img->url() ?>); background-color: <?= $site->backgroundOverlayColor() ?>; background-blend-mode: overlay; background-repeat: <?= $site->backgroundImageRepeat() ?>" role="contentinfo"<?php if($site->animateFooter()->isTrue()): ?> uk-scrollspy="<?php e($site->animateElement() == "divs", 'target: section > div > div > div; ') ?>cls: uk-animation-fade; delay: 200"<?php endif ?>>
<?php else: ?>
<footer <?php e($site->footerColor() == "muted", 'class="uk-background-muted"') ?><?php e($site->footerColor() == "primary", 'class="uk-background-primary uk-light"') ?><?php e($site->footerColor() == "secondary", 'class="uk-background-secondary uk-light"') ?> role="contentinfo"<?php if($site->animateFooter()->isTrue()): ?> uk-scrollspy="<?php e($site->animateElement() == "divs", 'target: section > div > div > div; ') ?>cls: uk-animation-slide-bottom-small; delay: 100"<?php endif ?>>
<?php endif ?>
<?php e($site->footerColor() == "default", '<hr>') ?>
<?php if($site->footerStyle() == "columns"): ?>
<?php snippet('footer/footer-columns') ?>
<?php else: ?>
<?php snippet('footer/footer-compact') ?>
<?php endif ?>
</footer>
<?php endif ?>
<?php endif ?>
<?php endif ?>
</div><!-- page end -->

<div id="offcanvas" uk-offcanvas="flip:<?php e($site->menuPosition() == "left", ' false', ' true') ?>; overlay: true;<?php e($site->mobileNavAnimation() == "push", ' mode: push;') ?><?php e($site->mobileNavAnimation() == "reveal", ' mode: reveal;') ?>">
  <div class="uk-offcanvas-bar uk-flex uk-flex-column">
  <button class="uk-offcanvas-close" type="button" uk-close></button>
  <?php if($site->searchicon() == "true" && $site->rightnav() != "button" && $site->searchiconMobile() == "true"): ?>
  <div class="uk-margin-medium-top uk-margin-medium-bottom">
    <form class="uk-search uk-search-navbar"<?php e($site->searchProducts()->isTrue(), ' method="get"', ' method="post"') ?> action="<?= page('search')->url() ?><?php e($site->searchProducts()->isTrue(), '/products') ?>">
    <span class="uk-search-icon-flip" uk-search-icon></span>
        <input class="uk-search-input" name="q" type="search" placeholder="<?= $site->labelSearchPlaceholder()->html() ?>">
    </form>
  </div>
  <?php else: ?>
  <div class="uk-margin-small-top uk-margin-medium-bottom">
    <?php snippet('header/navbar/logo') ?>
  </div>
  <?php endif ?>
  <?php if($site->mobileMenuInfoText()->isNotEmpty()): ?>
  <div class="uk-margin-small-top uk-margin-small-bottom">
    <?= $site->mobileMenuInfoText()->kt() ?>
  </div>
  <?php endif ?>
  <div class="uk-margin-auto-vertical">
  <?php if($site->mainMenuBuilder()->toStructure()->isNotEmpty()): ?>
  <?php snippet('menus/mobile-menu-builder') ?>
  <?php else: ?>
  <?php snippet('menus/menu-mobile') ?>
  <?php endif ?>
  </div>
  <div class="uk-margin-large-top">
    <div>
    <?php if($site->socialStyle() == "icons"): ?>
    <?php snippet('footer/social-icons') ?>
    <?php else: ?>
    <?php snippet('footer/social-links') ?>
    <?php endif ?>
    </div>
    <div class="uk-text-small uk-text-muted uk-margin-medium-top">
    &copy; <?= $site->title() ?>
    </div>
  </div>
  </div>
</div>
<?php if($site->enableCookieconsent()->isTrue()): ?>
<?php if($site->cookieConsenttype() == "modal"): ?>
<?php snippet('footer/cookie-modal') ?>
<?php else: ?>
<?php snippet('footer/cookie-popup') ?>
<?php endif ?>
<?php endif ?>
<?php if($site->footerCustomCode()->isNotEmpty()): ?>
<?= $site->footerCustomCode()->value() ?>
<?php endif ?>
<?php if($site->toTopButton()->isTrue()): ?>
<!-- Scroll to top button -->
<button class="tm-totop-button uk-button<?= ' ' . $site->toTopButtonStyle() ?>"><?php e($site->toTopButtonIcon()->isNotEmpty(), '<span class="uk-margin-small-right" uk-icon="icon:' . $site->toTopButtonIcon() . '"></span>') ?><?= $site->toTopButtonText()->html() ?></button>

<script type="text/javascript">
var scrollToTopBtn = document.querySelector(".tm-totop-button");
var rootElement = document.documentElement;

function handleScroll() {
  // Do something on scroll
  var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
  if (rootElement.scrollTop / scrollTotal > 0.2) {
    // Show button
    scrollToTopBtn.classList.add("tm-show-totop");
  } else {
    // Hide button
    scrollToTopBtn.classList.remove("tm-show-totop");
  }
}

function scrollToTop() {
  // Scroll to top logic
  rootElement.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}
scrollToTopBtn.addEventListener("click", scrollToTop);
document.addEventListener("scroll", handleScroll);
</script>
<?php endif ?>
<?php if($site->pageTransitions()->isTrue() && !($site->snipcartSwitch()->isTrue())): ?>
<?php if($site->cachebusting()->isTrue()): ?>
<?= Bnomei\Fingerprint::js('/assets/js/dist/js/main.min.js') ?>
<?php else: ?>
<?= js('/assets/js/dist/js/main.min.js') ?>
<?php endif ?>
<?php endif ?>
<?php if($site->enableCookieconsent()->isTrue()): ?>
<?php if($site->cachebusting()->isTrue()): ?>
<?= Bnomei\Fingerprint::js('/assets/js/scripts/cookieconsent.js') ?>
<?php else: ?>
<?= js('/assets/js/scripts/cookieconsent.js') ?>
<?php endif ?>
<?php endif ?>
<?php if($site->syntaxHighlighting()->isTrue()): ?>
<?php if($site->cachebusting()->isTrue()): ?>
<?= Bnomei\Fingerprint::js('/assets/js/scripts/prism.min.js') ?>
<?php else: ?>
<?= js('/assets/js/scripts/prism.min.js') ?>
<?php endif ?>
<?php endif ?>

</body>
</html>