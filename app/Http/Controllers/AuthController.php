<?php namespace Cryptic\Wgrpg\Http\Controllers;

use Cryptic\Wgrpg\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\Factory as View;

class AuthController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Construct a new instance of the controller.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->auth = $auth;
    }

    /**
     * Get the login page.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getLogin(View $view)
    {
        return $view->make('auth.login');
    }

    /**
     * Attempt to login user.
     *
     * @param \Cryptic\Wgrpg\Http\Requests\Auth\LoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended($this->resolveRedirectRoute());
        }

        // TODO: Flash error messages?

        return redirect()->route('auth.login')
            ->withInput($request->only('username', 'remember'));
    }

    /**
     * Logout user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect()->route('auth.login');
    }

    /**
     * Resolve which route to return based on the users roles.
     *
     * @return string
     */
    protected function resolveRedirectRoute()
    {
        if ($this->auth->hasRole('Admin')) {
            return route('admin.dashboard');
        }

        return route('dashboard');
    }
}
