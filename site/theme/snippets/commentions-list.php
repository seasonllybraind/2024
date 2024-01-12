<hr>
<div class="uk-margin">

  <?php foreach ($reactions as $type => $group) : ?>
    <h3><?= $group->label() ?></h3>

    <ul class="commentions-list-reactions commentions-list-reactions-<?= $type ?>">
      <?php foreach ($group->items() as $comment) : ?>

        <li>
        <div class="uk-background-primary uk-padding">
          <a href="<?= $comment->source() ?>"><?= $comment->name()->html() ?></a>
        </div>
        </li>

      <?php endforeach ?>
    </ul>
  <?php endforeach ?>

  <?php if ($comments->count() > 0) : ?>
    <h3><?= t('commentions.snippet.list.comments') ?></h3>

    <ul class="uk-comment-list">
        <?php foreach ($comments as $comment) : ?>

        <li class="commentions-list-item commentions-list-item-<?= $comment->type() ?><?= r($comment->isAuthenticated(), ' commentions-list-item-authenticated') ?>">
        <div class="uk-comment uk-comment-primary uk-visible-toggle" tabindex="-1">
            <header class="uk-comment-header uk-position-relative">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-expand">
                      <h4 class="uk-comment-title uk-margin-remove">
                        <?= $comment->sourceFormatted() ?>
                      </h4>
                      <p class="uk-comment-meta uk-margin-remove-top">
                        <?= $comment->dateFormatted() ?>
                      </p>
                      </div>
                </div>
            </header>
            <hr class="uk-divider-small">
            <?php if ($comment->text()->isNotEmpty()): ?>
              <div class="uk-comment-body">
                <?= $comment->text() ?>
              </div>
            <?php endif ?>
          </div>
          </li>

        <?php endforeach ?>
    </ul>
  <?php endif ?>

</div>
