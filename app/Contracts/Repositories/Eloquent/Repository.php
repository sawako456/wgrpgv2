<?php namespace Cryptic\Wgrpg\Contracts\Repositories\Eloquent;

use Closure;

interface Repository
{
    /**
     * Return all entities.
     *
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with, $trashed);

    /**
     * Count all entities.
     *
     * @param bool $trashed
     *
     * @return int
     */
    public function count($trashed);

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $with
     */
    public function make(array $with);

    /**
     * Find an entity by id.
     *
     * @param int   $id
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with, $trashed);

    /**
     * Find an entity by id.
     *
     * @param int   $id
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($id, array $with, $trashed);

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
    public function findWhereOrFail($id, $column, $operator, $value,
        array $with, $trashed);

    /**
     * Find an entity by id or create it.
     *
     * @param mixed $id
     * @param array $input
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, array $input);

    /**
     * Get the first entity.
     *
     * @param array $with
     * @param bool  $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first(array $with, $trashed);

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
    public function firstWhere($column, $operator, $value, array $with, $trashed);

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
    public function firstWhereOrFail($column, $operator, $value, array $with,
        $trashed);

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
    public function getWhere($column, $operator, $value, array $with, $trashed);

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
    public function getWhereIn($column, array $values, array $with, $trashed);

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
    public function getByPage($page, $limit, array $with, Closure $searcher,
        Closure $sorter, Closure $filter, $trashed);

    /**
     * Return all entities that have a required relationship.
     *
     * @param string $relation
     * @param array  $with
     * @param bool   $trashed
     *
     * @return \Illuminate\Support\Collection
     */
    public function has($relation, array $with, $trashed);

    /**
     * Create a new entity.
     *
     * @param array $input
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $input);

    /**
     * Save a entity.
     *
     * @param mixed $model
     *
     * @return bool
     */
    public function save($model);

    /**
     * Delete a entity.
     *
     * @param mixed $model
     *
     * @return null|bool
     */
    public function delete($model);

    /**
     * Restore a entity.
     *
     * @param mixed $model
     *
     * @return null|bool
     */
    public function restore($model);
}
