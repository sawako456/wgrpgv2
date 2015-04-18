<?php namespace Cryptic\Wgrpg\Handlers\Events\Auth;

use Carbon\Carbon;
use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\User\Repository as UserRepositoryContract;

class LoginListener
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\User\Repository
     */
    protected $users;

    /**
     * Create the event handler.
     *
     * @param \Cryptic\Wgrpg\Contracts\Repositories\User\Repository
     *
     * @return void
     */
    public function __construct(UserRepositoryContract $users)
    {
        $this->users = $users;
    }

    /**
     * Handle the event. Recieves the logged in user entity and a boolean
     * indicating if the remeber token was set.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     * @param bool                                   $remember
     *
     * @return void
     */
    public function handle(UserEntityContract $user, $remember = false)
    {
        $user->logins += 1;
        $user->last_login_at = Carbon::now();

        $this->users->save($user);
    }
}
