<?php

return function ($site) {
    return $site->index()->filterBy('template', 'article')->listed()->sortBy('date')->flip();
};
