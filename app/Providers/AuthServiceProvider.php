<?php namespace Cryptic\Wgrpg\Providers;

use Cryptic\Wgrpg\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['auth']->extend('cryptic.auth', function ($app) {
            $model = ['model' => $app['config']['auth.model']];

            return new Guard(
                $app->make('Illuminate\Auth\EloquentUserProvider', $model),
                $this->app['session.store'],
                null, // null or instanceof Request
                $this->app->make('Cryptic\Wgrpg\Contracts\Repositories\User\Repository')
            );
        });
    }
}
