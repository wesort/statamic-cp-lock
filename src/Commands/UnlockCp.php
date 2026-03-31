<?php

namespace WeSort\CpLock\Commands;

use Illuminate\Console\Command;
use Statamic\Console\RunsInPlease;

class UnlockCp extends Command
{
    use RunsInPlease;

    protected $signature = 'cp:unlock';
    protected $description = 'Unlock the Statamic Control Panel.';

    public function handle()
    {
        if (! file_exists(storage_path('framework/cp_down'))) {
            $this->error('The Control Panel is not currently locked.');
            return;
        }

        unlink(storage_path('framework/cp_down'));
        $this->info('Control Panel is now unlocked.');
    }
}
