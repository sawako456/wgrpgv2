<?php namespace Cryptic\Wgrpg\Lib\Domain\Repositories\Eloquent;

use Closure;
use Cryptic\Wgrpg\Contracts\Repositories\Eloquent\Repository as EloquentRepositoryContract;
use stdClass;

/**
 * @see http://culttt.com/2014/03/17/eloquent-tricks-better-repositories/
 */
abstract class AbstractRepository implements EloquentRepositoryContract
{
    /**
     * Return all entities.
     *
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        return $query->get();
    }

    /**
     * Count all entities.
     *
     * @param bool $trashed
     *
     * @return int
     */
    public function count($trashed = false)
    {
        if ($trashed) {
            return $this->model->withTrashed()->count();
        }

        return $this->model->count();
    }

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $with
     */
    public function make(array $with = [])
    {
        return $this->model->with($with);
    }

    /**
     * Find an entity by id.
     *
     * @param int   $id
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        return $query->find($id);
    }

    /**
     * Find an entity by id.
     *
     * @param int   $id
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($id, array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        return $query->findOrFail($id);
    }

    /**
     * Find a single entity with id and where column is value or fail.
     *
     * @param int    $column
     * @param string $column
     * @param string $operator
     * @param string $value
     * @param array  $with
     * @param bool   $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findWhereOrFail($id, $column, $operator = '=', $value = null,
        array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        if ($column instanceof Closure) {
            return $query->where($column)->findOrFail($id);
        }

        return $query->where($column, $operator, $value)->findOrFail($id);
    }

    /**
     * Find an entity by id or create it.
     *
     * @param mixed $id
     * @param array $input
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, array $input)
    {
        return $this->model->findOrNew($id, $input);
    }

    /**
     * Get the first entity.
     *
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first(array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        return $query->first();
    }

    /**
     * Find a single entity where column is value.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     * @param array  $with
     * @param bool   $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstWhere($column, $operator = '=', $value = null,
        array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        if ($column instanceof Closure) {
            return $query->where($column)->first();
        }

        return $query->where($column, $operator, $value)->first();
    }

    /**
     * Find a single entity where column is value or fail.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     * @param array  $with
     * @param bool   $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstWhereOrFail($column, $operator = '=', $value = null,
        array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        if ($column instanceof Closure) {
            return $query->where($column)->firstOrFail();
        }

        return $query->where($column, $operator, $value)->firstOrFail();
    }

    /**
     * Find many entities where column is value.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     * @param array  $with
     * @param bool   $trashed
     *
     * @return \Illuminate\Support\Collection
     */
    public function getWhere($column, $operator = '=', $value = null,
        array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        return $query->where($column, $operator, $value)->get();
    }

    /**
     * Find many entities where column is in value array.
     *
     * @param string $column
     * @param array  $values
     * @param array  $with
     * @param bool   $trashed
     *
     * @return \Illuminate\Support\Collection
     */
    public function getWhereIn($column, array $values = [], array $with = [],
        $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        return $query->whereIn($column, $values)->get();
    }

    /**
     * Get Results by Page.
     *
     * All closures are optional. Possible to extend repository with methods
     * following this syntax: get[Searcher|Sorter|Filter], e.g. getFilter.
     * The method will be executed if the corresponding argument is not an
     * instance of \Closure.
     *
     * @param int      $page
     * @param int      $limit
     * @param array    $with
     * @param \Closure $searcher
     * @param \Closure $sorter
     * @param \Closure $filter
     * @param bool     $trashed
     *
     * @return \stdClass
     */
    public function getByPage($page, $limit = 10, array $with = [],
        Closure $searcher = null, Closure $sorter = null, Closure $filter = null,
        $trashed = false)
    {
        $result = new stdClass();
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = [];
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        if ($searcher instanceof Closure) {
            $searcher($query);
        } elseif (method_exists($this, 'getSearcher')) {
            $searcher = $this->getSearcher();
            $searcher($query);
        }

        if ($sorter instanceof Closure) {
            $sorter($query);
        } elseif (method_exists($this, 'getSorter')) {
            $sorter = $this->getSorter();
            $sorter($query);
        }

        if ($filter instanceof Closure) {
            $filter($query);
        } elseif (method_exists($this, 'getFilter')) {
            $filter = $this->getFilter();
            $filter($query);
        }

        $result->totalItems = $query->count();

        $model = $query->skip($limit * ($page - 1))
            ->take($limit)
            ->get();

        $result->items = $model->all();

        return $result;
    }

    /**
     * Return all entities that have a required relationship.
     *
     * @param string $relation
     * @param array  $with
     * @param bool   $trashed
     *
     * @return \Illuminate\Support\Collection
     */
    public function has($relation, array $with = [], $trashed = false)
    {
        $query = $this->make($with);

        if ($trashed) {
            $query->withTrashed();
        }

        return $query->has($relation)->get();
    }

    /**
     * Create a new entity.
     *
     * @param array $input
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Save a entity.
     *
     * @param mixed $model
     *
     * @return bool
     */
    public function save($model)
    {
        return $model->save();
    }

    /**
     * Delete a entity.
     *
     * @param mixed $model
     *
     * @return null|bool
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * Restore a entity.
     *
     * @param mixed $model
     *
     * @return null|bool
     */
    public function restore($model)
    {
        return $model->restore();
    }
}
