<?php namespace Cryptic\Wgrpg\Contracts\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Eloquent as EloquentEntityContract;

interface World extends EloquentEntityContract
{
    /**
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user();

    /**
     * Maps relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maps();
}
