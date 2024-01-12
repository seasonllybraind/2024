<?php 

$uniqueID         = $data->uniqueID()->isNotEmpty() ? $data->uniqueID() : null;
$textSize         = $data->textSize()->isNotEmpty() ? $data->textSize() : null;
$loop             = $data->loop()->or('true')->value();
$shuffle          = $data->shuffle()->or('false')->value();
$typeSpeed        = $data->typeSpeed()->or('75')->toInt();
$backDelay        = $data->backDelay()->or('900')->toInt();
$showCursor       = $data->showCursor()->or('true')->value();
$customCursor     = $data->customCursor()->or('|')->value();
$blockID          = $data->blockID()->isNotEmpty() ? 'id="' . $data->blockID()->value() . '" ' : null;
$blockClass       = $data->blockClass()->isNotEmpty() ? ' ' . $data->blockClass()->value() : null;
$marginVertical   = $data->marginVertical()->isNotEmpty() ? $data->marginVertical() : null;
$marginLeft       = $data->marginLeft()->isNotEmpty() ? $data->marginLeft() : null;
$marginRight      = $data->marginRight()->isNotEmpty() ? $data->marginRight() : null;

?>
<div id="<?= $uniqueID ?>-strings">
<?php $strings = $data->strings()->toStructure(); foreach ($strings as $string): ?>
  <p><?= $string->string() ?></p>
<?php endforeach ?>
</div>
<div <?= $blockID ?>class="<?= $textSize ?><?= $blockClass ?><?= $marginVertical ?><?= $marginLeft ?><?= $marginRight ?>"><span id="<?= $uniqueID ?>" class="<?= $blockClass ?><?= $marginVertical ?><?= $marginLeft ?><?= $marginRight ?>"></span></div>
<script>
  var typed = new Typed('#<?= $uniqueID ?>', {
    stringsElement: '#<?= $uniqueID ?>-strings',
    typeSpeed: <?= $typeSpeed ?>,
    backDelay: <?= $backDelay ?>,
    loop: <?= $loop ?>,
    shuffle: <?= $shuffle ?>,
    showCursor: <?= $showCursor ?>,
    cursorChar: '<?= $customCursor ?>',
  });
</script>