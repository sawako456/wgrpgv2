<?php namespace Cryptic\Wgrpg\Http\ViewComposers\Admin;

use Cryptic\Wgrpg\Contracts\Repositories\World\Repository as WorldRepositoryContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserComposer
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\World\Repository
     */
    protected $worlds;

    /**
     * Create a new instance of the composer.
     *
     * @param \Illuminate\Http\Request                               $auth
     * @param \Cryptic\Wgrpg\Contracts\Repositories\World\Repository $worlds
     *
     * @return void
     */
    public function __construct(Request $request, WorldRepositoryContract $worlds)
    {
        $this->request = $request;
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
        $userId = $this->request->route('id');
        $worldCount = $this->worlds->getWhere('user_id', $userId)->count();

        $view->with(compact('worldCount'));
    }
}
