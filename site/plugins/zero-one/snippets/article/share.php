<nav aria-label="Social share">
<div class="uk-article-meta uk-margin-small">   
<?= $site->labelShareArticle()->html() ?>
</div>

<a class="uk-icon-button uk-margin-small-right" href="https://www.facebook.com/sharer/sharer.php?u=<?= rawurlencode ($page->url()) ?>" target="_blank" uk-icon="facebook"></a>

<a class="uk-icon-button uk-margin-small-right" href="https://twitter.com/intent/tweet?source=webclient&text=<?= rawurlencode($page->title()) ?>%20<?= rawurlencode ($page->url()) ?>%20<?= ('via') ?> <?= $site->twitteruser() ?>" target="_blank" uk-icon="twitter"></a>

<a class="uk-icon-button uk-margin-small-right" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= rawurlencode ($page->url()) ?>&title=<?= rawurlencode($page->title()) ?>" target="_blank" uk-icon="linkedin"></a>

<a class="uk-icon-button uk-margin-small-right" href="https://pinterest.com/pin/create/button/?url=<?= rawurlencode ($page->url()) ?>&description=<?= rawurlencode($page->title()) ?>" target="_blank" uk-icon="pinterest"></a>

<a class="uk-icon-button" href="mailto:?subject=<?= $site->title() ?> - <?= $page->title() ?>&body=<?= rawurlencode ($page->url()) ?>" target="_blank" uk-icon="mail"></a>
     
</nav>
