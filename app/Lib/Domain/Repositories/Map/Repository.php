<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\Map;

use Cryptic\Wgrpg\Contracts\Entities\Map as MapEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\Map\Repository as MapRepositoryContract;
use Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent\AbstractRepository;

class Repository extends AbstractRepository implements MapRepositoryContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Entities\Map
     */
    protected $model;

    /**
     * Construct a new instance of the repository.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\Map $model
     *
     * @return void
     */
    public function __construct(MapEntityContract $model)
    {
        $this->model = $model;
    }
}
