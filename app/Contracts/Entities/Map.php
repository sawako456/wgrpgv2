<?php namespace Cryptic\Wgrpg\Contracts\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Eloquent as EloquentEntityContract;

interface Map extends EloquentEntityContract
{
    /**
     * World relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function world();

    /**
     * Tiles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiles();
}
