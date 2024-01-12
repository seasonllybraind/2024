<div class="commentions-feedback">

  <?php if (isset($alert)): ?>
    <?php foreach ($alert as $message): ?>
      <div class="uk-alert-primary" uk-alert>
      <p><?= html($message) ?></p>
      </div>
    <?php endforeach ?>
  <?php endif ?>

  <?php if (get('thx') == 'queued') : ?>
    <div class="uk-alert-success" uk-alert>
    <p><?= $success ?></p>
    </div>
  <?php endif ?>

  <?php if (get('thx') == 'accepted') : ?>
    <div class="uk-alert-success" uk-alert>
    <p><?= $accepted ?></p>
    </div>
  <?php endif ?>

</div>
