<?php namespace Cryptic\Wgrpg\Providers;

use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider {

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Cryptic\Wgrpg\Contracts\Entities\User',
			'Cryptic\Wgrpg\Lib\Domain\Entities\User');
	}

}
