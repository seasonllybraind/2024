<section class="uk-section uk-section-medium">
<div class="uk-container uk-container-xsmall uk-text-center">
<?= $site->footerCompactText()->toBlocks() ?>
</div>
<div class="uk-flex uk-flex-center uk-margin-large">
<?php if($site->socialStyle() == "icons"): ?>
<?php snippet('footer/social-icons') ?>
<?php else: ?>
<?php snippet('footer/social-links') ?>
<?php endif ?>
</div>
<?php if($site->subfooterToggle() != "false"): ?>
<hr>
<div class="uk-margin-large-top">
    <p class="uk-text-small uk-text-muted uk-text-center">
    &copy; <?= date('Y') ?> / <a href="<?= url() ?>"><?= $site->title() ?></a>.
    <?php if ($site->copyright()->isNotEmpty()): ?>
    <?= h($site->copyright(), true) ?>
    <?php endif ?>
    </p>
</div>
<?php endif ?>
</section>