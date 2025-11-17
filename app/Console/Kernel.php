<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register custom Artisan commands manually.
     */
    protected $commands = [
        // We can register commands here manually,
        // but the load() method below will auto-load all commands in app/Console/Commands.
    ];

    /**
     * Define scheduled tasks for `php artisan schedule:run`.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Example:
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register commands and load the console routes.
     */
    protected function commands(): void
    {
        // Auto-load all PHP command files in app/Console/Commands/
        $this->load(__DIR__ . '/Commands');

        // Load the routes/console.php file if it exists
        if (file_exists(base_path('routes/console.php'))) {
            require base_path('routes/console.php');
        }
    }
}
