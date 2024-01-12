
  <div class="commentions-form">

    <?php if (option('sgkirby.commentions.hideforms')) : ?>

    <h3 id="commentions-form-comment">
      <button class="uk-button uk-button-default" type="button" uk-toggle="target: #commentions-comment-form">
        <?= t('commentions.snippet.form.ctacomment') ?>
      </button>
    </h3>

    <?php else : ?>

    <h3 id="commentions-form-comment"><?= t('commentions.snippet.form.ctacomment') ?></h3>

    <?php endif; ?>

    <form id="commentions-comment-form" action="<?= $page->url() ?>" method="post" class="uk-grid-small"<?= option('sgkirby.commentions.hideforms') ? ' hidden' : '' ?> uk-grid>

      <?php if (array_key_exists('name', $fields)) : ?>
      <div class="uk-width-1-2@s">
        <label class="uk-form-label" for="name"><?= $fields['name']['label'] ?></label>
        <input class="uk-input" type="text" id="name" name="name" <?= $fields['name']['required'] ? 'required' : '' ?>>
      </div>
      <?php endif; ?>

      <?php if (array_key_exists('email', $fields)) : ?>
      <div class="uk-width-1-2@s">
        <label class="uk-form-label" for="email"><?= $fields['email']['label'] ?></label>
        <input class="uk-input" type="email" id="email" name="email" <?= $fields['email']['required'] ? 'required' : '' ?>>
      </div>
      <?php endif; ?>

      <div class="tm-hon">
        <label for="website"><?= t('commentions.snippet.form.honeypot') ?></label>
        <input type="url" id="website" name="website">
      </div>

      <?php if (array_key_exists('website', $fields)) : ?>
      <div class="uk-width-1-1">
        <label class="uk-form-label" for="realwebsite"><?= $fields['website']['label'] ?></label>
        <input class="uk-input" type="url" id="realwebsite" name="realwebsite" <?= $fields['website']['required'] ? 'required' : '' ?>>
      </div>
      <?php endif; ?>

      <div class="uk-width-1-1">
        <label class="uk-form-label" for="message"><?= $fields['message']['label'] ?></label>
        <textarea class="uk-textarea uk-height-small" id="message" name="message" rows="8" required></textarea>
        <?php commentions('help') ?>
      </div>

      <div class="uk-width-1-1">
      <?php /* "commentions" value enables identifying commentions submissions in route:before hook + creation timestamp is used for spam protection */ ?>
      <input type="hidden" name="commentions" value="<?php e(!$page->isCacheable(), time(), 0) ?>">

      <button class="uk-button uk-button-primary" type="submit" name="submit" value="Submit"><?= t('commentions.snippet.form.submitcomment') ?></button>
      </div>

    </form>

    <?php if (\sgkirby\Commentions\Commentions::accepted($page, 'webmentions')) : ?>

    <?php if (option('sgkirby.commentions.expand')) : ?>

    <h3 id="commentions-form-webmention">
      <button class="uk-button uk-button-default" type="button" uk-toggle="target: #commentions-mention-form">
      <?= t('commentions.snippet.form.ctawebmention') ?>
      </button>
    </h3>

    <?php else : ?>

    <h3 id="commentions-form-comment"><?= t('commentions.snippet.form.ctawebmention') ?></h3>

    <?php endif; ?>

    <form id="commentions-mention-form" action="<?= kirby()->urls()->base() . '/' . option('sgkirby.commentions.endpoint') ?>" method="post" class="uk-grid"<?= option('sgkirby.commentions.expand') ? ' hidden' : '' ?> uk-grid>

      <div class="uk-width-1-1">
        <label class="uk-form-label" for="source"><?= t('commentions.snippet.form.responseurl') ?></label>
        <input class="uk-input" type="url" id="source" name="source" pattern=".*http.*" required>
      </div>

      <div class="uk-width-1-1">
      <input type="hidden" name="target" value="<?= $page->url() ?>">
      <input type="hidden" name="manualmention" value="true">

      <button class="uk-button uk-button-primary" type="submit" name="submit" value="Send webmention"><?= t('commentions.snippet.form.submitwebmention') ?></button>
      </div>
      
    </form>

    <?php endif; ?>

  </div>
