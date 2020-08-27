<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

abstract class CommandAbstract extends Command
{
    protected function log(string $message, string $level): void
    {
        if (config('app.debug')) {
            Log::debug($message);
        }
        $this->output->{$level}($message);
    }
}
