<?php namespace Cryptic\Wgrpg\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('timezone', 'Cryptic\Wgrpg\Support\Time\TimeZone');
    }
}
