<?php if($image = $site->favicon()->toImage()): ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?= $image->clip(180)->url() ?>" />
<link rel="icon" type="image/png" href="<?= $image->clip(196)->url() ?>" sizes="196x196" />
<link rel="icon" type="image/png" href="<?= $image->clip(96)->url() ?>" sizes="96x96" />
<link rel="icon" type="image/png" href="<?= $image->clip(32)->url() ?>" sizes="32x32" />
<link rel="icon" type="image/png" href="<?= $image->clip(16)->url() ?>" sizes="16x16" />
<meta name="msapplication-TileImage" content="<?= $image->clip(150)->url() ?>" />
<?php endif ?>