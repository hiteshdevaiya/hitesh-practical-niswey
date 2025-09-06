<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository
{
    protected string $modelClass;
    protected Model $model;

    public function __construct(?string $modelClass = null)
    {
        $this->modelClass = $modelClass ?? static::guessModelClass();
        $this->model = app($this->modelClass);

    }

    private static function guessModelClass(): string
    {
        return preg_replace('/(.+)\\\\Repositories\\\\(.+)Repository$/m', '$1\Models\\\$2', static::class);
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    public function getQuery(): Builder
    {
        return $this->model->newQuery();
    }

    public function findWhere(array $conditions = [], array $relations = [], array $scopes = []): Builder
    {
        $query = $this->applyScopes($this->model->with($relations), $scopes);

        foreach ($conditions as $key => $condition) {
            if (is_array($condition)) {
                $this->applyArrayCondition($query, $condition);
            } else {
                $query->where($key, $condition);
            }
        }

        return $query;
    }

    protected function applyArrayCondition(Builder $query, array $condition): void
    {
        if (count($condition) === 3) {
            [$column, $operator, $value] = $condition;
            $query->where($column, $operator, $value);
        } elseif (count($condition) === 2) {
            [$column, $value] = $condition;
            $query->where($column, $value);
        } else {
            $query->where(function ($q) use ($condition) {
                foreach ($condition as $c) {
                    $this->applyArrayCondition($q, $c);
                }
            });
        }
    }

    public function getOneById(int|string $id): ?Model
    {
        return $this->model->find($id);
    }

    public function firstOrFail(int|string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /** @return Collection<int, Model> */
    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    /**
     * Get all models with optional relations and scopes.
     *
     * @param array<int,string> $relations
     * @param array<int, callable|string> $scopes
     * @return Collection<int, Model>
     */
    public function getAll(array $relations = [], array $scopes = []): Collection
    {
        $query = $this->applyScopes($this->model->with($relations), $scopes);

        return $query->get();
    }

    public function getFirstWhere(...$params): ?Model
    {
        return $this->model->firstWhere(...$params);
    }

    public function getOneByIdWith(
        int|string $id,
        array $relations = [],
        array $whereHas = [],
        array $wheres = [],
        array $scopes = []
    ): Model {
        $query = $this->applyScopes($this->model->with($relations), $scopes);

        foreach ($whereHas as $relation => $callback) {
            $query->whereHas($relation, $callback);
        }

        foreach ($wheres as $column => $value) {
            $query->where($column, $value);
        }

        return $query->findOrFail($id);
    }

    public function paginate(int $perPage = 15, array $relations = [], array $scopes = []): LengthAwarePaginator
    {
        $query = $this->applyScopes($this->model->with($relations), $scopes);

        return $query->paginate($perPage);
    }

    /**
     * Apply local scopes or closures on the query.
     *
     * @param Builder $query
     * @param array<int, callable|string> $scopes
     * @return Builder
     */
    protected function applyScopes(Builder $query, array $scopes): Builder
    {
        foreach ($scopes as $scope) {
            if (is_callable($scope)) {
                $query = $scope($query);
            } elseif (is_string($scope) && method_exists($this->model, 'scope' . ucfirst($scope))) {
                $query = $query->$scope();
            }
        }

        return $query;
    }
}
