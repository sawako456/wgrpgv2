<?php namespace Cryptic\Wgrpg\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->composer('components.navbar',
            'Cryptic\Wgrpg\Http\ViewComposers\NavbarComposer');

        $this->app['view']->composer('admin.dashboard',
            'Cryptic\Wgrpg\Http\ViewComposers\Admin\DashboardComposer');

        $this->app['view']->composer('admin.users.show',
            'Cryptic\Wgrpg\Http\ViewComposers\Admin\UserComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
