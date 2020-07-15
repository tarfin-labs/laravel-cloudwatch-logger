<?php

namespace TarfinLabs\LaravelCloudwatchLogger\Tests;

use Orchestra\Testbench\TestCase;
use TarfinLabs\LaravelCloudWatchLogger\LaravelCloudWatchLoggerServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelCloudWatchLoggerServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
