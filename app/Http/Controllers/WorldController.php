<?php namespace Cryptic\Wgrpg\Http\Controllers;

use Cryptic\Wgrpg\Contracts\Repositories\World\Repository as WorldRepositoryContract;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\Factory as View;

class WorldController extends Controller
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\World\Repository
     */
    protected $worlds;

    /**
     * Construct a new instance of the controller.
     *
     * @param \Cryptic\Wgrpg\Contracts\Repositories\World\Repository $worlds
     *
     * @return void
     */
    public function __construct(WorldRepositoryContract $worlds)
    {
        $this->middleware('auth');
        $this->middleware('player');

        $this->worlds = $worlds;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Guard $auth, View $view)
    {
        $worlds = $this->worlds->getWhere('user_id', '=', $auth->id());

        return $view->make('world.select', compact('worlds'));
    }
}
