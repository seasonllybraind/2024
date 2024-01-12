<?php

return function ($kirby, $site, $page) {
    $lang = $kirby->languages()->isNotEmpty() ? $kirby->language() : null;
    $lang = $kirby->language()->isDefault() === null;

    $custom_discount = $page->customDiscountprice()->isNotEmpty() ? (($page->customPrice()->toInt() - $page->customDiscountprice()->toInt())*100) / $page->customPrice()->toInt() : null;
    $snipcart_discount = $page->snipcartDiscountprice()->isNotEmpty() ? (($page->snipcartPrice()->toInt() - $page->snipcartDiscountprice()->toInt())*100) / $page->snipcartPrice()->toInt() : null;

    $coverimg_width = $site->productImageratio() == "3:4" ? '900' : '800';
    $coverimg_height = $site->productImageratio()->isNotEmpty() ? ($site->productImageratio() == "4:3" ? '600' : '1200') : '800';

    return [
      'lang' => $lang,
      'custom_discount' => $custom_discount,
      'snipcart_discount' => $snipcart_discount,
      'coverimg_width' => $coverimg_width,
      'coverimg_height' => $coverimg_height
    ];
};
