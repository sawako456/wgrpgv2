<?php namespace Cryptic\Wgrpg\Contracts\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Eloquent as EloquentEntityContract;

interface Role extends EloquentEntityContract
{
    /**
     * Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();
}
