<section<?php if($data->blockID()->isNotEmpty()): ?> id="<?= $data->blockID()->value() ?>"<?php endif ?> class="<?php e($data->editorBack() == "muted", 'uk-background-muted') ?><?php e($data->editorBack() == "primary", ' uk-background-primary uk-light') ?><?php e($data->editorBack() == "secondary", ' uk-background-secondary uk-light') ?><?php if($data->blockClass()->isNotEmpty()): ?> <?= $data->blockClass()->value() ?><?php endif ?>">
<div class="uk-container<?php e($data->editorWidth() == "xsmall", ' uk-container-xsmall') ?><?php e($data->editorWidth() == "small", ' uk-container-small') ?>">
<div class="uk-padding-large uk-padding-remove-horizontal<?php e($data->editorHeadings() == "true", ' tm-heading') ?>">
<?= $data->textEditor()->toBlocks() ?>
</div>
</div>
</section>