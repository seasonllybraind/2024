<figure>
  <ul class="uk-grid uk-grid-small<?= $block->imageWidth() ?>" uk-lightbox uk-grid>
    <?php foreach ($block->images()->toFiles() as $image): ?>
    <li>
    <?php $crop = $block->imageCropRatio()->split(','); ?>
      <a class="uk-inline" href="<?= $image->url() ?>" data-no-swup data-alt="<?= $image->alt() ?>" data-caption="<?= $image->caption() ?>">
        <img src="<?php if($block->imageCrop() == "true"): ?><?= $image->crop($crop[0] ?? 800, $crop[1] ?? 800)->url() ?><?php else: ?><?= $image->resize(800)->url() ?><?php endif ?>" alt="<?= $image->alt() ?>" loading="lazy">
        <?php if ($image->caption()->isNotEmpty()): ?>
        <figcaption class="uk-overlay uk-position-bottom uk-overlay-gradient uk-light uk-visible@m">
          <?= $image->caption() ?>
        </figcaption>
        <?php endif ?>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</figure>
