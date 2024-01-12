<!-- Social Media -->
<?php 
$socials = $site->social()->toStructure();
foreach($socials as $social): ?>
<a href="<?= $social->url() ?>" target="_blank"<?php e($social !== $socials->last(), ' class="uk-margin-medium-right"') ?> uk-icon="icon: <?= Str::lower($social->platform()) ?>;" uk-tooltip="<?= $social->platform() ?>"></a>
<?php endforeach ?>