<?php namespace Cryptic\Wgrpg\Lib\Domain\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Role as RoleEntityContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model implements RoleEntityContract
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    /**
     * Additional dates to mutate into instances of \Carbon\Carbon.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Cryptic\Wgrpg\Lib\Domain\Entities\User');
    }
}
