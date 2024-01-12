<?php

return function ($site) {
    $query   = get('q');
    $results = $site->index()->published()->bettersearch($query);
    $results = $results->paginate(20);

    return [
      'query'      => $query,
      'results'    => $results,
      'pagination' => $results->pagination()
    ];
};
