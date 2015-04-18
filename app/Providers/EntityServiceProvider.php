<?php namespace Cryptic\Wgrpg\Providers;

use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Cryptic\Wgrpg\Contracts\Entities\Event',
            'Cryptic\Wgrpg\Lib\Domain\Entities\Event');

        $this->app->bind('Cryptic\Wgrpg\Contracts\Entities\Map',
            'Cryptic\Wgrpg\Lib\Domain\Entities\Map');

        $this->app->bind('Cryptic\Wgrpg\Contracts\Entities\Role',
            'Cryptic\Wgrpg\Lib\Domain\Entities\Role');

        $this->app->bind('Cryptic\Wgrpg\Contracts\Entities\Tile',
            'Cryptic\Wgrpg\Lib\Domain\Entities\Tile');

        $this->app->bind('Cryptic\Wgrpg\Contracts\Entities\User',
            'Cryptic\Wgrpg\Lib\Domain\Entities\User');

        $this->app->bind('Cryptic\Wgrpg\Contracts\Entities\World',
            'Cryptic\Wgrpg\Lib\Domain\Entities\World');
    }
}
