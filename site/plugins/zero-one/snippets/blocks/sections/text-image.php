<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="<?php e($data->fitWidth() == "small", ' uk-container uk-container-small') ?><?php e($data->fitWidth() == "large", ' uk-container uk-container-large') ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<div class="uk-grid uk-grid-match uk-grid-collapse" uk-grid>
<?php if($img = $data->fitImage()->toFile()): ?>
<div class="uk-cover-container tm-min-height<?php e($data->fitImageSize() == "half", ' uk-width-1-2@m') ?><?php e($data->fitImageSize() == "onethird", ' uk-width-1-3@m') ?><?php e($data->fitImageSize() == "twothirds", ' uk-width-2-3@m') ?><?php e($data->viewportHeight() == "true", ' uk-height-viewport') ?>">
    <picture>
        <source type="image/webp" srcset="<?= $img->thumb(['format' => 'webp'])->url() ?>" />
        <img src="<?= $img->url() ?>" alt="<?= $img->alt() ?>" loading="lazy" uk-cover>
    </picture>
</div>
<?php else: ?>
<div class="uk-background-muted tm-min-height<?php e($data->fitImageSize() == "half", ' uk-width-1-2@m') ?><?php e($data->fitImageSize() == "onethird", ' uk-width-1-3@m') ?><?php e($data->fitImageSize() == "twothirds", ' uk-width-2-3@m') ?>"></div>
<?php endif ?>
    <div class="uk-width-expand@m uk-flex-middle<?php e($data->fitChooseSides() == "text", ' uk-flex-last uk-flex-first@m') ?><?php e($data->fitTextBack() == "muted", ' uk-background-muted') ?><?php e($data->fitTextBack() == "primary", ' uk-background-primary uk-light') ?><?php e($data->fitTextBack() == "secondary", ' uk-background-secondary uk-light') ?>">
        <div class="<?php e($data->fitTextPadding() == "default", 'uk-padding') ?><?php e($data->fitTextPadding() == "large", 'uk-padding-large') ?><?php e($data->fitTextPadding() == "xlarge", 'tm-padding-vertical-xlarge') ?><?php e($data->fitTextAlign() == "center", ' uk-text-center') ?><?php e($data->fitTextAlign() == "right", ' uk-text-right') ?><?php e($data->fitHeadings() == "true", ' tm-heading') ?>">
            <?= $data->fitText()->toBlocks() ?>
        </div>
    </div>
</div>
</section>