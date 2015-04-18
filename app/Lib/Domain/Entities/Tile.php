<?php namespace Cryptic\Wgrpg\Lib\Domain\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Tile as TileEntityContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tile extends Model implements TileEntityContract
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['x', 'y', 'z', 'text_entry', 'type', 'state', 'map_id'];

    /**
     * Additional dates to mutate into instances of \Carbon\Carbon.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Map relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function map()
    {
        return $this->belongsTo('Cryptic\Wgrpg\Lib\Domain\Entities\Map');
    }
}
