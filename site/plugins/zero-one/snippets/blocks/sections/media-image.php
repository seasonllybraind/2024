<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-cover-container<?php e($data->mediaImageHeight() == "medium", ' uk-height-medium') ?><?php e($data->mediaImageHeight() == "large", ' uk-height-large') ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>"<?php e($data->mediaImageHeight() == "viewport", ' uk-height-viewport="offset-top: true; offset-bottom: 10"') ?>>
<?php if($image = $data->mediaImage()->toFile()): ?>
<picture>
    <source type="image/webp" srcset="<?= $image->thumb(['format' => 'webp'])->url() ?>" />
    <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>" loading="lazy" uk-cover>
</picture>
<?php endif ?>
</section>