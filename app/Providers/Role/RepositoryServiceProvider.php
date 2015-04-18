<?php namespace Cryptic\Wgrpg\Providers\Role;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton('Cryptic\Wgrpg\Contracts\Repositories\Role\Repository',
            'Cryptic\Wgrpg\Lib\Domain\Repositories\Role\Repository');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Cryptic\Wgrpg\Contracts\Repositories\Role\Repository'];
    }
}
