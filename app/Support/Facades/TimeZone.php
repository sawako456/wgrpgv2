<?php namespace Cryptic\Wgrpg\Support\Facades;

use Illuminate\Support\Facades\Facade;

class TimeZone extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'timezone';
    }
}
