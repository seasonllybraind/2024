<?php

return function ($site, $pages, $page) {
    if ($page->redirect()->isNotEmpty() && ($p = $page->redirect()->toPage())) {
        // if 'redirect to page' is set (and exists), go for it
        $redirect = $p->url();
    } elseif ($page->link()->isNotEmpty()) {
        // if 'external url' is set, go for it
        $redirect = $page->link()->value();
    } else {
        // fallback: redirect to homepage
        $redirect = $site->errorPage();
    }

    return array(
      'redirect' => $redirect,
    );
};
