<section class="uk-section">
<div class="uk-container<?php if($site->footerWidth()->isNotEmpty()): ?> <?= $site->footerWidth() ?><?php endif ?>">
<div class="uk-grid" uk-grid>
<?php 
// using the `toStructure()` method, we create a structure collection
$items = $site->footerColumns()->toStructure();
// we can then loop through the entries and render the individual fields
foreach ($items as $item): ?>
<div class="<?php e($item->columnWidth() != "uk-width-1-1", 'uk-width-1-2@s ') ?><?= $item->columnWidth() ?><?php if($item->columnClass()->isNotEmpty()): ?> <?= $item->columnClass()->value() ?><?php endif ?>">
  <?php if($item->columnCard() == "true"): ?><div class="uk-card<?= $item->columnCardSize() ?><?= $item->columnCardColor() ?><?php e($item->columnCardHover() == "true", ' uk-card-hover') ?> uk-card-body"><?php endif ?>
  <?php if($item->columnContent() == "editor"): ?>
  <?= $item->columnEditor()->toBlocks() ?>
  <?php elseif($item->columnContent() == "html"): ?>
  <?= $item->columnHTML()->value() ?>
  <?php else: ?>
  <?= $item->footerColumn()->kt() ?>
  <?php endif ?>
  <?php if($item->columnCard() == "true"): ?></div><?php endif ?>
</div>
<?php endforeach ?>
</div>
</div>
</section>
<?php if($site->subfooterToggle() != "false"): ?>
<hr>
<div class="uk-container<?php if($site->footerWidth()->isNotEmpty()): ?> <?= $site->footerWidth() ?><?php endif ?>">
  <div class="uk-grid-margin uk-text-small uk-margin-medium-bottom uk-margin-top uk-grid" uk-grid>
    <div class="uk-width-expand@s">
    <?php if($site->socialStyle() == "icons"): ?>
    <?php snippet('footer/social-icons') ?>
    <?php else: ?>
    <?php snippet('footer/social-links') ?>
    <?php endif ?>
    </div>
    <div class="uk-width-auto@s uk-flex-last">
      <p class="footer-copyright uk-text-muted uk-text-right@s">
        &copy; <?= date('Y') ?> / <a href="<?= url() ?>"><?= $site->title() ?></a>.
        <?php if ($site->copyright()->isNotEmpty()): ?>
        <?= h($site->copyright(), true) ?>
        <?php endif ?>
      </p>
    </div>
  </div>
</div>
<?php endif ?>