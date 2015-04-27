<?php namespace Cryptic\Wgrpg\Auth;

use Cryptic\Wgrpg\Contracts\Repositories\User\Repository as UserRepositoryContract;
use Illuminate\Auth\Guard as IlluminateGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\MessageBag;
use Lang;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Guard extends IlluminateGuard
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\User\Repository
     */
    protected $users;

    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Create a new authentication guard.
     *
     * @param \Illuminate\Contracts\Auth\UserProvider                    $provider
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \Symfony\Component\HttpFoundation\Request                  $request
     * @param \Cryptic\Wgrpg\Contracts\Repositories\User\Repository      $users
     *
     * @return void
     */
    public function __construct(UserProvider $provider,
        SessionInterface $session, Request $request = null,
        UserRepositoryContract $users)
    {
        $this->session = $session;
        $this->request = $request;
        $this->provider = $provider;
        $this->users = $users;

        $this->errors = new MessageBag();
    }

    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param array $credentials
     * @param bool  $remember
     * @param bool  $login
     *
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false, $login = true)
    {
        $this->fireAttemptEvent($credentials, $remember, $login);

        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        // If an implementation of UserInterface was returned, we'll ask the provider
        // to validate the user against the given credentials, and if they are in
        // fact valid we'll log the users into the application and return true.
        if ($this->hasValidCredentials($user, $credentials)) {
            if ($this->hasLoginRole($user)) {
                if ($login) {
                    $this->login($user, $remember);
                }

                return true;
            }

            $this->errors->add('auth', Lang::get('messages.error.auth.role'));

            return false;
        }

        $this->errors->add('auth', Lang::get('messages.error.auth.credentials'));

        return false;
    }

    /**
     * Check if user has login role.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function hasLoginRole($user)
    {
        return !is_null($user) && $this->users->hasRole('Login', $user);
    }

    /**
     * Check if authenticable has role.
     * Argument can be one of string, array, or \Cryptic\Wgrpg\Contracts\Entities\Role.
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->check() && $this->users->hasRole($role, $this->user());
    }

    /**
     * Check if authenticable has role.
     *
     * @param array $roles
     *
     * @return bool
     */
    public function hasRoles(array $roles)
    {
        return $this->check() && $this->users->hasRoles($roles, $this->user());
    }

    /**
     * Get the errors message bag.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }
}
