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

    /**
     * Create a new user, sync roles and hash the given password.
     *
     * @param array $input
     * @param array $roles
     * @param bool  $hash
     *
     * @return \Cryptic\Wgrpg\Contracts\Entities\User
     */
    public function createUser(array $input, array $roles, $hash);

    /**
     * Create a new user with the player and login roles.
     *
     * @param array $input
     *
     * @return \Cryptic\Wgrpg\Contracts\Entities\User
     */
    public function createPlayer(array $input);
}
