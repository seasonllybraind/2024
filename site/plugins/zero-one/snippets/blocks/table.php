<?php if ($block->number() == "two"): ?>

<?php 
$rows = $block->two()->toStructure();
if($rows->isNotEmpty()):
?>
<div class="uk-overflow-auto uk-margin">
<table class="uk-table<?= $block->divider() ?><?= $block->size() ?><?php e($block->hover() == "true", ' uk-table-hover') ?><?php e($block->justify() == "true", ' uk-table-justify') ?>">
  <tr>
    <th><?= $block->twoOne() ?></th>
    <th><?= $block->twoTwo() ?></th>
  </tr>
  <?php foreach( $rows as $row): ?>
    <tr>
      <td><?= $row->column1() ?></td>
      <td><?= $row->column2() ?></td>
    </tr>
  <?php endforeach ?>
</table>
</div>
<?php endif; ?>

<?php elseif ($block->number() == "three"): ?>

<?php 
$rows = $block->three()->toStructure();
if($rows->isNotEmpty()):
?>
<div class="uk-overflow-auto uk-margin">
<table class="uk-table<?= $block->divider() ?><?= $block->size() ?><?php e($block->hover() == "true", ' uk-table-hover') ?><?php e($block->justify() == "true", ' uk-table-justify') ?>">
  <tr>
    <th><?= $block->threeOne() ?></th>
    <th><?= $block->threeTwo() ?></th>
    <th><?= $block->threeThree() ?></th>
  </tr>
  <?php foreach( $rows as $row): ?>
    <tr>
      <td><?= $row->column1() ?></td>
      <td><?= $row->column2() ?></td>
      <td><?= $row->column3() ?></td>
    </tr>
  <?php endforeach ?>
</table>
</div>
<?php endif; ?>

<?php elseif ($block->number() == "four"): ?>

<?php 
$rows = $block->four()->toStructure();
if($rows->isNotEmpty()):
?>
<div class="uk-overflow-auto uk-margin">
<table class="uk-table<?= $block->divider() ?><?= $block->size() ?><?php e($block->hover() == "true", ' uk-table-hover') ?><?php e($block->justify() == "true", ' uk-table-justify') ?>">
  <tr>
    <th><?= $block->fourOne() ?></th>
    <th><?= $block->fourTwo() ?></th>
    <th><?= $block->fourThree() ?></th>
    <th><?= $block->fourFour() ?></th>
  </tr>
  <?php foreach( $rows as $row): ?>
    <tr>
      <td><?= $row->column1() ?></td>
      <td><?= $row->column2() ?></td>
      <td><?= $row->column3() ?></td>
      <td><?= $row->column4() ?></td>
    </tr>
  <?php endforeach ?>
</table>
</div>
<?php endif; ?>

<?php elseif ($block->number() == "five"): ?>

<?php 
$rows = $block->five()->toStructure();
if($rows->isNotEmpty()):
?>
<div class="uk-overflow-auto uk-margin">
<table class="uk-table<?= $block->divider() ?><?= $block->size() ?><?php e($block->hover() == "true", ' uk-table-hover') ?><?php e($block->justify() == "true", ' uk-table-justify') ?>">
  <tr>
    <th><?= $block->fiveOne() ?></th>
    <th><?= $block->fiveTwo() ?></th>
    <th><?= $block->fiveThree() ?></th>
    <th><?= $block->fiveFour() ?></th>
    <th><?= $block->fiveFive() ?></th>
  </tr>
  <?php foreach( $rows as $row): ?>
    <tr>
      <td><?= $row->column1() ?></td>
      <td><?= $row->column2() ?></td>
      <td><?= $row->column3() ?></td>
      <td><?= $row->column4() ?></td>
      <td><?= $row->column5() ?></td>
    </tr>
  <?php endforeach ?>
</table>
</div>
<?php endif; ?>

<?php else: ?>
<p class="uk-margin">Add table columns</p>
<?php endif; ?>