<?php $descriptionItems = $data->description()->toStructure(); 

$blockID                 = $data->blockID()->isNotEmpty() ? 'id="' . $data->blockID()->value() . '" ' : null;
$blockClass              = $data->blockClass()->isNotEmpty() ? ' ' . $data->blockClass()->value() : null;
$titleSize               = $data->titleSize()->isNotEmpty() ? $data->titleSize() : null;
$titleTransform          = $data->titleTransform()->isNotEmpty() ? $data->titleTransform() : null;
$titleColor              = $data->titleColor()->isNotEmpty() ? $data->titleColor() : null;
$descriptionSize         = $data->descriptionSize()->isNotEmpty() ? $data->descriptionSize() : null;
$descriptionTransform    = $data->descriptionTransform()->isNotEmpty() ? $data->descriptionTransform() : null;
$descriptionColor        = $data->descriptionColor()->isNotEmpty() ? $data->descriptionColor() : null;

?>
<?php if($descriptionItems->isNotEmpty()): ?>
<dl <?= $blockID ?>class="uk-description-list<?= $blockClass ?>">
<?php foreach($descriptionItems as $item): ?>
    <dt<?php if($titleSize or $titleTransform or $titleColor): ?> class="<?= $titleSize ?><?= $titleTransform ?><?= $titleColor ?>"<?php endif ?>><?= $item->title() ?></dt>
    <dd<?php if($descriptionSize or $descriptionTransform or $descriptionColor): ?> class="<?= $descriptionSize ?><?= $descriptionTransform ?><?= $descriptionColor ?>"<?php endif ?>><?= $item->text() ?></dd>
<?php endforeach; ?>
</dl>
<?php endif; ?>