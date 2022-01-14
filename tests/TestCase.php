<?php

namespace Label84\StatsHelper\Tests;

use Label84\StatsHelper\StatsHelperServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            StatsHelperServiceProvider::class,
        ];
    }
}
