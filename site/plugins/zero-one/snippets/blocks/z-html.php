<?php 
 
$blockID          = $data->blockID()->isNotEmpty() ? ' id="' . $data->blockID()->value() . '"' : null;
$blockClass       = $data->blockClass()->isNotEmpty() ? ' class="' . $data->blockClass()->value() . '"' : null;

?>

<div<?= $blockID ?><?= $blockClass ?>>
<?= $data->htmlCode()->value() ?>
</div>