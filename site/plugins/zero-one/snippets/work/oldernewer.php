<?php if ($projects->pagination()->hasPages()): ?>
<!-- Pagination -->
<section class="uk-flex uk-flex-center uk-padding uk-margin-large">
<div>
  <?php if ($projects->pagination()->hasNextPage()): ?>
  <a class="uk-button uk-button-primary" href="<?= $projects->pagination()->nextPageURL() ?>">
    <?= $site->labelOlder()->html() ?>
  </a>
  <?php endif ?>

  <?php if ($projects->pagination()->hasPrevPage()): ?>
  <a class="uk-button uk-button-primary" href="<?= $projects->pagination()->prevPageURL() ?>">
    <?= $site->labelNewer()->html() ?>
  </a>
  <?php endif ?>
</div>
</section>
<?php endif ?>