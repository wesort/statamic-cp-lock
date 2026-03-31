<?php

namespace WeSort\CpLock;

use Statamic\Providers\AddonServiceProvider;
use WeSort\CpLock\Commands\LockCp;
use WeSort\CpLock\Commands\UnlockCp;
use WeSort\CpLock\Commands\LockCpStatus;

class ServiceProvider extends AddonServiceProvider
{
    protected $commands = [
        LockCp::class,
        UnlockCp::class,
        LockCpStatus::class,
    ];

    protected $middlewareGroups = [
        'statamic.cp.authenticated' => [
            \WeSort\CpLock\Middleware\PreventCpAccess::class,
        ],
    ];

    public function bootAddon()
    {
        //
    }
}
