<?php

namespace Label84\StatsHelper;

use Illuminate\Support\ServiceProvider;

class StatsHelperServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StatsHelper::class, function ($app) {
            return new StatsHelper();
        });

        $this->app->bind(StatsArrayHelper::class, function ($app) {
            return new StatsArrayHelper();
        });
    }

    public function boot(): void
    {
        //
    }
}
