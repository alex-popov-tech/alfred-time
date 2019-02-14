<?php

use Godbout\Alfred\Item;
use Godbout\Alfred\ScriptFilter;

ScriptFilter::add(
    Item::create()
        ->title('Enter your API KEY above')
        ->subtitle('Your API KEY will be saved.')
        ->arg('setup_toggl_apikey_save'),
    Item::create()
        ->title('Back')
        ->subtitle('Go back to Toggl options')
        ->arg('setup_toggl')
);
