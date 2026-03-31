<?php

namespace WeSort\CpLock\Tests;

use WeSort\CpLock\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
