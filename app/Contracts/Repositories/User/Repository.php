<?php namespace Cryptic\Wgrpg\Contracts\Repositories\User;

use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;

interface Repository
{
    /**
     * Check if user has role.
     *
     * @param mixed                                  $role
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     *
     * @return bool
     */
    public function hasRole($role, UserEntityContract $user);

    /**
     * Check if user has roles.
     *
     * @param array                                  $roles
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     *
     * @return bool
     */
    public function hasRoles(array $roles, UserEntityContract $user);
}
