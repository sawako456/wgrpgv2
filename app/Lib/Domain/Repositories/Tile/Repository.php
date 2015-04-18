<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\Tile;

use Cryptic\Wgrpg\Contracts\Entities\Tile as TileEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\Tile\Repository as TileRepositoryContract;
use Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent\AbstractRepository;

class Repository extends AbstractRepository implements TileRepositoryContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Entities\Tile
     */
    protected $model;

    /**
     * Construct a new instance of the repository.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\Tile $model
     *
     * @return void
     */
    public function __construct(TileEntityContract $model)
    {
        $this->model = $model;
    }
}
