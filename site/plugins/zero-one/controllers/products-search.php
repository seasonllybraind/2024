<?php

return function ($site) {

  $query   = get('q');
  $results = $site->index()->filterBy('template', 'product')->published()->bettersearch($query);
  $results = $results->paginate(20);

  return [
    'query'      => $query,
    'results'    => $results,
    'pagination' => $results->pagination()
  ];

};