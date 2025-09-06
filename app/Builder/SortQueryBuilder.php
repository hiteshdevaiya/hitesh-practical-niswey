<?php

namespace App\Builder;

use Illuminate\Database\Eloquent\Builder;

class SortQueryBuilder
{
    public static function apply(
        Builder $query,
        ?string $sortCol,
        bool $sortAsc = false,
        array $sortableMap = [],
        array $joinMap = [],
        array $virtualFields = []
    ): Builder {
        if (!$sortCol || in_array($sortCol, $virtualFields, true)) {
            return $query;
        }

        $mainTable = $query->getModel()->getTable();
        $direction = $sortAsc ? 'asc' : 'desc';
        $column = $sortableMap[$sortCol] ?? $sortCol;

        if (empty($query->getQuery()->columns)) {
            $query->select("{$mainTable}.*");
        }

        if (str_contains($column, '->')) {
            return $query->orderByRaw("JSON_UNQUOTE(JSON_EXTRACT({$column})) {$direction}");
        }

        if (str_contains($column, '.')) {
            [$alias, $field] = explode('.', $column, 2);

            self::applyJoinIfNeeded($query, $alias, $joinMap);

            return $query->orderBy("{$alias}.{$field}", $direction);
        }

        return $query->orderBy($column, $direction);
    }

    protected static function applyJoinIfNeeded(Builder $query, string $alias, array $joinMap): void
    {
        foreach ($joinMap as $tableWithAlias => $joinDetails) {
            if (
                str_ends_with($tableWithAlias, " as {$alias}") ||
                $tableWithAlias === $alias
            ) {
                if (!self::hasJoin($query, $alias)) {
                    $query->leftJoin(
                        $tableWithAlias,
                        $joinDetails['localKey'],
                        '=',
                        $joinDetails['foreignKey']
                    );
                }

                return;
            }
        }
    }

    protected static function hasJoin(Builder $query, string $alias): bool
    {
        return collect($query->getQuery()->joins ?? [])
            ->pluck('table')
            ->contains($alias);
    }
}
