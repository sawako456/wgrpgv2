<?php namespace Cryptic\Wgrpg\Lib\Domain\Entities;

use Cryptic\Wgrpg\Contracts\Entities\World as WorldEntityContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class World extends Model implements WorldEntityContract
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'worlds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'seed', 'time', 'user_id'];

    /**
     * Additional dates to mutate into instances of \Carbon\Carbon.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Cryptic\Wgrpg\Lib\Domain\Entities\User');
    }

    /**
     * Maps relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maps()
    {
        return $this->hasMany('Cryptic\Wgrpg\Lib\Domain\Entities\Map');
    }
}
