<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\Role;

use Cryptic\Wgrpg\Contracts\Entities\Role as RoleEntityContract;
use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\Role\Repository as RoleRepositoryContract;
use Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent\AbstractRepository;

class Repository extends AbstractRepository implements RoleRepositoryContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Entities\Role
     */
    protected $model;

    /**
     * Construct a new instance of the repository.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\Role $model
     *
     * @return void
     */
    public function __construct(RoleEntityContract $model)
    {
        $this->model = $model;
    }

    /**
     * Return roles belong to a user.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     * @param array                                  $with
     * @param bool                                   $trashed
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserRoles(UserEntityContract $user, array $with = [],
        $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        $id = $user->id;

        return $query->whereHas('users', function ($query) use ($id) {
                $query->where('users.id', $id);
            })
            ->get();
    }
}
