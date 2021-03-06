<?php namespace Cryptic\Wgrpg\Http\Controllers\Admin;

use Cryptic\Wgrpg\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory as View;

class DashboardController extends Controller
{
    /**
     * Construct a new instance of the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Get the dashboard.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getDashboard(View $view)
    {
        return $view->make('admin.dashboard');
    }
}
