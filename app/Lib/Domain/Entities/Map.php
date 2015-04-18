<?php namespace Cryptic\Wgrpg\Lib\Domain\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Map as MapEntityContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Map extends Model implements MapEntityContract
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'text_entry', 'type', 'world_id'];

    /**
     * Additional dates to mutate into instances of \Carbon\Carbon.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * World relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function world()
    {
        return $this->belongsTo('Cryptic\Wgrpg\Lib\Domain\Entities\World');
    }

    /**
     * Tiles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiles()
    {
        return $this->hasMany('Cryptic\Wgrpg\Lib\Domain\Entities\Tile');
    }
}
