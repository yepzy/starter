<?php

namespace App\Console\Commands\Dev;

use Illuminate\Console\Command;

class IdeHelperHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide-helper:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handles ide-helper generation through composer.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ideHelperProvider = '\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider';
        if (in_array(app()->environment(), ['local', 'development']) && class_exists($ideHelperProvider)) {
            $this->call('ide-helper:generate');
            $this->call('ide-helper:meta');
        }
    }
}
