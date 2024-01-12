<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="uk-cover-container<?php e($data->mediaVideoHeight() == "medium", ' uk-height-medium') ?><?php e($data->mediaVideoHeight() == "large", ' uk-height-large') ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>"<?php e($data->mediaVideoHeight() == "viewport", ' uk-height-viewport="offset-top: true; offset-bottom: 10"') ?>>
<?php if($data->mediaVideoSource() == "upload"): ?>
<?php if($video = $data->mediaVideo()->toFile()): ?>
<video src="<?= $video->url() ?>" autoplay loop muted playsinline uk-cover></video>
<?php endif ?>
<?php else: ?>
<iframe src="<?= $data->mediaVideoUrl() ?>" width="1920" height="1080" frameborder="0" allowfullscreen uk-cover></iframe>
<?php endif ?>
</section>