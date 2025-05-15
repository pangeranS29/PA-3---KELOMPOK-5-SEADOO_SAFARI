<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\CheckExpiredBookings;
use Illuminate\Support\Facades\Schedule as ScheduleFacade;

// Registrasi command
Artisan::command('bookings:check-expired', function () {
    $this->call(CheckExpiredBookings::class);
})->purpose('Check and update expired bookings');

// Scheduling command
ScheduleFacade::command(CheckExpiredBookings::class)->everyMinute();
