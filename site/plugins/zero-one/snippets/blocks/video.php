<figure>
<?php if($block->videosource() == "upload"): ?>
<?php if($video = $block->videofile()->toFile()): ?>
<video src="<?= $video->url() ?>" class="uk-responsive<?php e($site->siteShadows() == "true", ' uk-box-shadow-medium') ?><?php e($site->siteBorderRadius() == "true", ' uk-border-rounded') ?>"<?php if($img = $block->poster()->toFile()): ?> poster="<?= $img->url() ?>"<?php endif ?> controls uk-responsive uk-video="autoplay: false"></video>
<?php if ($block->caption()->isNotEmpty()): ?>
<figcaption><?= $block->caption() ?></figcaption>
<?php endif ?>
<?php endif ?>
<?php else: ?>
<?php if ($block->url()->isNotEmpty()): ?>
<iframe src="<?= $block->url() ?>" class="uk-responsive<?php e($site->siteShadows() == "true", ' uk-box-shadow-medium') ?><?php e($site->siteBorderRadius() == "true", ' uk-border-rounded') ?>" width="1920" height="1080" frameborder="0" allowfullscreen uk-responsive uk-video="autoplay: false"></iframe>
<?php if ($block->caption()->isNotEmpty()): ?>
<figcaption><?= $block->caption() ?></figcaption>
<?php endif ?>
<?php endif ?>
<?php endif ?>
</figure>