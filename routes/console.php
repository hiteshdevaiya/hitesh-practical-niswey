<?php

use App\Jobs\PruneTelescopeEntries;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

app()->booted(function () {
    $schedule = app(Schedule::class);

    // $schedule->job(new PruneTelescopeEntries(1))->hourlyAt(0);
});
