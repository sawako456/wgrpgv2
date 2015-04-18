<?php namespace Cryptic\Wgrpg\Auth;

use Illuminate\Auth\Guard as IlluminateGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Guard extends IlluminateGuard
{
    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array  $credentials
     * @param  bool   $remember
     * @param  bool   $login
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
        if ($this->hasValidCredentials($user, $credentials) && $this->hasLoginRole($user))
        {
            if ($login) {
                $this->login($user, $remember);
            }

            return true;
        }

        return false;
    }

    public function hasLoginRole($user)
    {
        return !is_null($user) && $user->hasRole('Login');
    }
}
