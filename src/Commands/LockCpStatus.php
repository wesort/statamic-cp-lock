<?php

namespace WeSort\CpLock\Commands;

use Illuminate\Console\Command;
use Statamic\Console\RunsInPlease;

class LockCpStatus extends Command
{
    use RunsInPlease;

    protected $signature = 'cp:lock-status';
    protected $description = 'Check the current lock status of the Statamic Control Panel.';

    public function handle()
    {
        $lockFile = storage_path('framework/cp_down');

        if (file_exists($lockFile)) {
            $this->info('Control Panel is currently LOCKED');
            $this->line('Users can browse but cannot save or modify content.');

            // Show when it was locked
            $lockedAt = filemtime($lockFile);
            $this->line('Locked since: ' . date('Y-m-d H:i:s', $lockedAt));

            return 0;
        }

        $this->info('Control Panel is currently UNLOCKED');
        $this->line('Users can browse and modify content normally.');

        return 0;
    }
}
