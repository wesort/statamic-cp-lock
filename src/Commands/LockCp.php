<?php

namespace WeSort\CpLock\Commands;

use Illuminate\Console\Command;
use Statamic\Console\RunsInPlease;

class LockCp extends Command
{
    use RunsInPlease;

    protected $signature = 'cp:lock';
    protected $description = 'Lock the Statamic Control Panel to prevent changes.';

    public function handle()
    {
        if (file_exists(storage_path('framework/cp_down'))) {
            $this->error('The Control Panel is already locked.');
            return;
        }

        touch(storage_path('framework/cp_down'));
        $this->info('Control Panel is now locked.');
    }
}
