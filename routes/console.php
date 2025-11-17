<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Here you may define all of your Closure-based console commands.
| These commands are only accessible via the CLI.
|
*/

Artisan::command('hello', function () {
    $this->info('Console routes are working!');
});
