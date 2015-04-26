<?php namespace Cryptic\Wgrpg\Providers\User;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Cryptic\Wgrpg\Contracts\Services\User\Service',
            'Cryptic\Wgrpg\Lib\Domain\Services\User\Service');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Cryptic\Wgrpg\Contracts\Services\User\Service'];
    }
}
