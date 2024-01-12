<?php

return function ($site) {
    return $site->index()->filterBy('template', 'project')->listed();
};
