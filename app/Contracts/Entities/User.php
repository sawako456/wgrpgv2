<?php namespace Cryptic\Wgrpg\Contracts\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Eloquent as EloquentEntityContract;

interface User extends EloquentEntityContract
{
    /**
     * Roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}
