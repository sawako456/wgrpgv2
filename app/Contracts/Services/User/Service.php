<?php namespace Cryptic\Wgrpg\Contracts\Services\User;

use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;

interface Service
{
    /**
     * Get all roles for a user or all roles.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function roles($id);

    /**
     * Sync user roles.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     * @param array                                  $roles
     *
     * @return array
     */
    public function syncRoles(UserEntityContract $user, array $roles);
}
