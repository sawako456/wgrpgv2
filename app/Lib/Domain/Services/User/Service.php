<?php namespace Cryptic\Wgrpg\Lib\Domain\Services\User;

use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\Role\Repository as RoleRepositoryContract;
use Cryptic\Wgrpg\Contracts\Repositories\User\Repository as UserRepositoryContract;
use Cryptic\Wgrpg\Contracts\Services\User\Service as UserServiceContract;

class Service implements UserServiceContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\User\Repository
     */
    protected $users;

    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\Role\Repository
     */
    protected $roles;

    /**
     * Construct a new instance of the service.
     *
     * @param \Cryptic\Wgrpg\Contracts\Repositories\User\Repository $users
     * @param \Cryptic\Wgrpg\Contracts\Repositories\Role\Repository $roles
     *
     * @return void
     */
    public function __construct(UserRepositoryContract $users,
        RoleRepositoryContract $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Get all roles for a user or all roles.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function roles($id = null)
    {
        if ($id instanceof UserEntityContract) {
            return $this->roles->getUserRoles($id);
        } elseif (!is_null($id)) {
            $user = $this->users->findOrFail($id);

            return $this->roles->getUserRoles($id);
        }

        return $this->roles->all();
    }

    /**
     * Sync user roles.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     * @param array                                  $roles
     *
     * @return array
     */
    public function syncRoles(UserEntityContract $user, array $roles)
    {
        return $user->roles()->sync($roles);
    }

    /**
     * Handle missing method calls.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array(array($this->users, $method), $parameters);
    }
}
