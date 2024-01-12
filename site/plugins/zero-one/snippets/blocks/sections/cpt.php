<?php if($data->cptStyle() == "image"): ?>
<?php if($img = $data->cptImage()->toFile()): ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section uk-background-cover uk-light<?= $data->cptSize() ?><?= $data->cptImagePosition() ?><?= $data->cptImageSize() ?><?= $data->cptTextColor() ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>"<?php if($img->extension() !== "svg"): ?> sources="[{&quot;srcset&quot;: &quot;<?= $img->thumb(['format' => 'webp'])->url() ?>&quot;,&quot;type&quot;: &quot;image\/webp&quot;}]"<?php endif ?> data-src="<?= $img->url() ?>" style="background-color: <?= $data->cptOverlayColor() ?>; background-blend-mode: overlay; background-repeat:<?= $data->cptImageRepeat() ?>" uk-img="loading: eager">
<?php else: ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?= $data->cptSize() ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<?php endif ?>
<?php else: ?>
<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-section<?= $data->cptStyle() ?><?= $data->cptSize() ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<?php endif ?>
<div class="uk-container uk-padding<?php e($data->cptTextWidth() == "small", ' uk-container-small') ?>">
    <div class="uk-flex-middle uk-text-center uk-text-left@m uk-grid" uk-grid>
        <div class="uk-width-expand@m<?php e($data->cptHeadings() == "true", ' tm-heading') ?>">
        <?= $data->cptText()->kt() ?>
        </div>
        <?php if($button = $data->cptLink()->toPage()): ?>
        <div class="uk-width-auto@m uk-text-right@m">
        <a class="uk-button<?= $data->cptButtonColor() ?><?php e($data->cptButtonSize() == "large", ' uk-button-large') ?>" href="<?= $button->url() ?>"><?= h($data->cptLinkText()) ?></a>
        </div>
        <?php endif ?>
    </div>
</div>
</section>