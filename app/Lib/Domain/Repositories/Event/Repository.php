<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\Event;

use Cryptic\Wgrpg\Contracts\Entities\Event as EventEntityContract;
use Cryptic\Wgrpg\Contracts\Repositories\Event\Repository as EventRepositoryContract;
use Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent\AbstractRepository;

class Repository extends AbstractRepository implements EventRepositoryContract
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Entities\Event
     */
    protected $model;

    /**
     * Construct a new instance of the repository.
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\Event $model
     *
     * @return void
     */
    public function __construct(EventEntityContract $model)
    {
        $this->model = $model;
    }
}
