<?php

$style        = $data->lineStyle()->isNotEmpty() ? $data->lineStyle()->value() : null;

?>
<hr <?php if($style): ?>class="<?= $style ?>"<?php endif ?>/>