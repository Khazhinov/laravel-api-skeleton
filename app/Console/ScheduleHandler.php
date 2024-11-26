<?php

namespace App\Console;

use Illuminate\Cache\Console\PruneStaleTagsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Telescope\Console\PruneCommand;

class ScheduleHandler
{
    public function __invoke(Schedule $schedule): void
    {
        $schedule->command(PruneCommand::class)->weekly();
        $schedule->command(PruneStaleTagsCommand::class)->hourly();

        // ...
    }
}
