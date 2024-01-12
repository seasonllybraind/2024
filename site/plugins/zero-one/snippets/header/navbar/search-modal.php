<div id="modal-full" class="uk-modal-full uk-modal" uk-modal>
    <div class="uk-modal-dialog uk-container uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-light uk-background-secondary" uk-height-viewport>
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <h4 class="uk-text-muted uk-text-center"><?= $site->labelSearchText()->html() ?></h4>
        <form class="uk-search uk-search-large"<?php e($site->searchProducts()->isTrue(), ' method="get"', ' method="post"') ?> action="<?= page('search')->url() ?><?php e($site->searchProducts()->isTrue(), '/products') ?>">
            <input class="uk-search-input uk-text-center" name="q" type="search" placeholder="<?= $site->labelSearchPlaceholder()->html() ?>" autofocus>
        </form>
    </div>
</div>