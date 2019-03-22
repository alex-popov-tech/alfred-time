<?php

namespace Godbout\Alfred\Time\Menus;

use Godbout\Alfred\Time\Workflow;
use Godbout\Alfred\Workflow\Icon;
use Godbout\Alfred\Workflow\Item;
use Godbout\Alfred\Workflow\ScriptFilter;

class SetupTogglState extends Menu
{
    public static function scriptFilter()
    {
        self::saveState();

        ScriptFilter::add(
            self::stateSaved(),
            self::back()
        );
    }

    private static function saveState()
    {
        Workflow::disableAllServices();

        getenv('toggl_enabled') === 'true'
            ? Workflow::enableService('toggl')
            : Workflow::disableService('toggl');
    }

    private static function stateSaved()
    {
        return Item::create()
            ->title(self::stateTitle())
            ->subtitle(self::stateSubtitle())
            ->arg('notification')
            ->icon(Icon::create('resources/icons/toggl.png'));
    }

    private static function stateTitle()
    {
        return 'Toggl ' . ((getenv('toggl_enabled') === 'true') ? 'ENABLED!' : 'DISABLED!');
    }

    protected static function stateSubtitle()
    {
        return ((getenv('toggl_enabled') === 'true')
            ? 'Other services disabled. '
            : ''
        ) . 'You may press enter to quit the workflow';
    }

    private static function back()
    {
        return Item::create()
            ->title('Back')
            ->subtitle('Go back to Toggl options')
            ->arg('setup_toggl')
            ->icon(Icon::create('resources/icons/toggl.png'));
    }
}
