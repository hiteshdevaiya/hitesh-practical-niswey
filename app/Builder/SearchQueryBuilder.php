<?php

namespace App\Builder;

use Illuminate\Database\Eloquent\Builder;

class SearchQueryBuilder
{
    public static function apply(Builder $query, string $search, array $primaryFields, array $relations = [], array $virtualFields = []): Builder
    {
        if (trim($search) === '') return $query;

        return $query->where(function ($q) use ($search, $primaryFields, $relations, $virtualFields) {
            // Search primary fields (JSON/lang support)
            foreach ($primaryFields as $field) {
                if (str_contains($field, '->')) {
                    $q->orWhere($field, 'LIKE', "%{$search}%");
                } else {
                    $q->orWhere($field, 'LIKE', "%{$search}%");
                }
            }

            foreach ($relations as $relation => $relationFields) {
                $q->orWhereHas($relation, function ($subQ) use ($search, $relationFields) {
                    $subQ->where(function ($subSubQ) use ($search, $relationFields) {
                        foreach ($relationFields as $field) {
                            $subSubQ->orWhere($field, 'LIKE', "%{$search}%");
                        }
                    });
                });
            }

            // Search virtual/computed fields
            foreach ($virtualFields as $expression) {
                $q->orWhereRaw("{$expression} LIKE ?", ["%{$search}%"]);
            }

            // foreach ($customAttributes as $attribute => $handler) {
            //     if (
            //         is_array($handler) &&
            //         isset($handler['prefix'], $handler['field']) &&
            //         preg_match('/^' . preg_quote($handler['prefix'], '/') . '[-_@]??(\d+)$/i', $search, $matches)
            //     ) {
            //         $id = (int) $matches[1];
            //         $q->orWhere($handler['field'], $id);
            //     }
            // }
        });
    }
}
