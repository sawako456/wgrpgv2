<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\User;

use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\User\Repository as UserRepositoryContract;
use Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent\AbstractRepository;

class Repository extends AbstractRepository implements UserRepositoryContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Entities\User
     */
    protected $model;

    /**
     * Construct a new instance of the repository.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $model
     *
     * @return void
     */
    public function __construct(UserEntityContract $model)
    {
        $this->model = $model;
    }
}
