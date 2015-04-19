<?php namespace Cryptic\Wgrpg\Http\ViewComposers\Admin;

use Cryptic\Wgrpg\Contracts\Repositories\User\Repository as UserRepositoryContract;
use Cryptic\Wgrpg\Contracts\Repositories\World\Repository as WorldRepositoryContract;
use Illuminate\Contracts\View\View;

class DashboardComposer
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\User\Repository
     */
    protected $users;

    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\World\Repository
     */
    protected $worlds;

    /**
     * Create a new instance of the composer.
     *
     * @param \Cryptic\Wgrpg\Contracts\Repositories\User\Repository  $users
     * @param \Cryptic\Wgrpg\Contracts\Repositories\World\Repository $worlds
     *
     * @return void
     */
    public function __construct(UserRepositoryContract $users,
        WorldRepositoryContract $worlds)
    {
        $this->users = $users;
        $this->worlds = $worlds;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $userCount = $this->users->count();
        $worldCount = $this->worlds->count();

        $view->with(compact('userCount', 'worldCount'));
    }
}
