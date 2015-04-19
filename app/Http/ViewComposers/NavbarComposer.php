<?php namespace Cryptic\Wgrpg\Http\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\UrlGenerator;

class NavbarComposer
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $url;

    /**
     * Create a new instance of the composer.
     *
     * @param \Illuminate\Contracts\Auth\Guard
     * @param \Illuminate\Routing\UrlGenerator
     *
     * @return void
     */
    public function __construct(Guard $auth, UrlGenerator $url)
    {
        $this->auth = $auth;
        $this->url = $url;
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
        if ($this->auth->hasRole('Admin')) {
            $dashboardRoute = $this->url->route('admin.dashboard');
            $profileRoute = $this->url->route('admin.profile.edit');
        } else {
            $dashboardRoute = $this->url->route('dashboard');
            $profileRoute = '#player_profile';
        }

        $view->with(compact('dashboardRoute', 'profileRoute'));
    }
}
