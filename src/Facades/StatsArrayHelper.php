<?php

namespace Label84\StatsHelper\Facades;

use Illuminate\Support\Facades\Facade;

class StatsArrayHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Label84\StatsHelper\StatsArrayHelper::class;
    }
}
