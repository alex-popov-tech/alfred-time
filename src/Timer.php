<?php

namespace Godbout\Alfred\Time;

class Timer
{
    public static function start()
    {
        $toggl = new Toggl(Workflow::getConfig()->read('toggl.api_token'));

        return (bool) $toggl->startTimer();
    }

    public static function stop()
    {
        return true;
    }
}
