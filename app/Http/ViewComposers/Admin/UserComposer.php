<?php namespace Cryptic\Wgrpg\Http\ViewComposers\Admin;

use Cryptic\Wgrpg\Contracts\Repositories\World\Repository as WorldRepositoryContract;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;

class UserComposer
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\World\Repository
     */
    protected $worlds;

    /**
     * Create a new instance of the composer.
     *
     * @param \Illuminate\Contracts\Auth\Guard                       $auth
     * @param \Cryptic\Wgrpg\Contracts\Repositories\World\Repository $worlds
     *
     * @return void
     */
    public function __construct(Guard $auth, WorldRepositoryContract $worlds)
    {
        $this->auth = $auth;
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
        $worldCount = $this->worlds->getWhere('user_id', $this->auth->id())->count();

        $view->with(compact('worldCount'));
    }
}
