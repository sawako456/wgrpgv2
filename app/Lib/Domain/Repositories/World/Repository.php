<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\World;

use Cryptic\Wgrpg\Contracts\Entities\World as WorldEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\World\Repository as WorldRepositoryContract;
use Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent\AbstractRepository;

class Repository extends AbstractRepository implements WorldRepositoryContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Entities\World
     */
    protected $model;

    /**
     * Construct a new instance of the repository.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\World $model
     *
     * @return void
     */
    public function __construct(WorldEntityContract $model)
    {
        $this->model = $model;
    }
}
