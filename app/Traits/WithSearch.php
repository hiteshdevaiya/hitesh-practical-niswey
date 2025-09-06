<?php

namespace App\Traits;

use App\Builder\SearchQueryBuilder;

trait WithSearch
{
    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    protected function searchableFields(): array
    {
        return [];
    }

    protected function searchableRelations(): array
    {
        return [];
    }

    protected function virtualSearchExpressions(): array
    {
        return [];
    }

    // protected function customAttributeHandlers(): array
    // {
    //     return [];
    // }

    protected function applySearch($query)
    {
        return SearchQueryBuilder::apply(
            $query,
            $this->search,
            $this->searchableFields(),
            $this->searchableRelations(),
            $this->virtualSearchExpressions(),
            // $this->customAttributeHandlers()
        );
    }
}
