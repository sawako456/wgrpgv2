<?php namespace Cryptic\Wgrpg\Providers\Map;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class RepositoryServiceProvider extends BaseServiceProvider
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
        $this->app->singleton('Cryptic\Wgrpg\Contracts\Repositories\Map\Repository',
            'Cryptic\Wgrpg\Lib\Domain\Repositories\Map\Repository');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Cryptic\Wgrpg\Contracts\Repositories\Map\Repository'];
    }
}
