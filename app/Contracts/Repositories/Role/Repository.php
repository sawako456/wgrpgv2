<?php namespace Cryptic\Wgrpg\Contracts\Repositories\Role;

use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;

interface Repository
{
    /**
     * Return roles belong to a user.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     * @param array                                  $with
     * @param bool                                   $trashed
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserRoles(UserEntityContract $user, array $with, $trashed);
}
