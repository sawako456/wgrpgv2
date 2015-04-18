<?php namespace Cryptic\Wgrpg\Lib\Domain\Entities;

use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;
use Cryptic\Wgrpg\Contracts\Entities\Role as RoleEntityContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, UserEntityContract
{
    use Authenticatable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Additional dates to mutate into instances of \Carbon\Carbon.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Check if user has role.
     * WARNING: Eloquent usage outside of repository!
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->whereHas('roles', function (QueryBuilder $query) use ($role) {
                $name = $role;

                if ($role instanceof RoleEntityContract) {
                    $name = $role->name;
                }

                $query->where('roles.name', $name);
            })->count() !== 0;
    }

    /**
     * Roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Cryptic\Wgrpg\Lib\Domain\Entities\Role');
    }
}
