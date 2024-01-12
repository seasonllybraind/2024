<?php if ($site->social()->isNotEmpty()): ?>
<ul class="uk-grid" uk-grid>
<?php foreach ($site->social()->toStructure() as $social): ?>
<li><?= html::a($social->url(), $social->platform(), ['target' => '_blank']) ?></li>
<?php endforeach ?>
</ul>
<?php endif ?>