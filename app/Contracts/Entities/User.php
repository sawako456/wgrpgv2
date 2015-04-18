<?php namespace Cryptic\Wgrpg\Contracts\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Eloquent as EloquentEntityContract;

interface User extends EloquentEntityContract
{
    /**
     * Check if user has role.
     * WARNING: Eloquent usage outside of repository!
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function hasRole($role);

    /**
     * Roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}
