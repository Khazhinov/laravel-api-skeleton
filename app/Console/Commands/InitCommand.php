<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;
use Throwable;

class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init migration service.';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $this->components->info('Start migrations.');

        Artisan::call('migrate', [
            '--force' => true,
        ], outputBuffer: $this->output);

        $this->components->info('Init complete.');

        return self::SUCCESS;
    }
}
