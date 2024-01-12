<?php

return function ($kirby, $page) {
    $lang = $kirby->languages()->isNotEmpty() ? $kirby->language() : null;
    $lang = $kirby->language()->isDefault() === null;

    return [
      'lang' => $lang,
    ];
};
