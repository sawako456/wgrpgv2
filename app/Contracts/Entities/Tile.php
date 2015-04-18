<?php namespace Cryptic\Wgrpg\Contracts\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Eloquent as EloquentEntityContract;

interface Tile extends EloquentEntityContract
{
    /**
     * Map relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function map();
}
