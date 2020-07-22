<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

abstract class CommandAbstract extends Command
{
    protected function log(string $message, ?string $level = 'info'): void
    {
        $acceptedLevels = ['success', 'info', 'error'];
        if (! (in_array($level, $acceptedLevels))) {
            throw new InvalidArgumentException('Invalid level provided. Level should be one of these: '
                . collect($acceptedLevels)->implode(', ') . '. ' . $level . ' given.');
        }
        if (config('app.debug')) {
            Log::debug($message);
        }
        switch ($level) {
            case 'success':
                $this->output->success($message);
                break;
            case 'error':
                $this->output->error($message);
                break;
            case 'info':
            default:
                $this->output->title($message);
                break;
        }
    }
}
