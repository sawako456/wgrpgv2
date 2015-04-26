<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\User;

use Cryptic\Wgrpg\Contracts\Entities\Role as RoleEntityContract;
use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\User\Repository as UserRepositoryContract;
use Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent\AbstractRepository;

class Repository extends AbstractRepository implements UserRepositoryContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Entities\User
     */
    protected $model;

    /**
     * Construct a new instance of the repository.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $model
     *
     * @return void
     */
    public function __construct(UserEntityContract $model)
    {
        $this->model = $model;
    }

    /**
     * Check if user has role.
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function hasRole($role, UserEntityContract $user)
    {
        if (is_array($role)) {
            return $this->hasRoles($role, $user);
        }

        return $this->model->where('users.id', $user->id)
            ->whereHas('roles', function ($query) use ($role) {
                $name = $role;

                if ($role instanceof RoleEntityContract) {
                    $name = $role->name;
                }

                $query->where('roles.name', $name);
            })->count() !== 0;
    }

    /**
     * Check if user has roles.
     *
     * @param array $roles
     *
     * @return bool
     */
    public function hasRoles(array $roles, UserEntityContract $user)
    {
        return $this->model->where('users.id', $user->id)
            ->whereHas('roles', function ($query) use ($roles) {
                $query->whereIn('roles.name', $roles);
            })->count() !== 0;
    }
}
