<?php $accordionItems = $block->accordion()->toStructure(); ?>
<?php if($accordionItems->isNotEmpty()): ?>
<ul class="uk-accordion" uk-accordion>
<?php foreach($accordionItems as $item): ?>
    <li>
        <a class="uk-accordion-title" href="#" data-no-swup><?= $item->question() ?></a>
        <div class="uk-accordion-content"><?= $item->answer() ?></div>
    </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>