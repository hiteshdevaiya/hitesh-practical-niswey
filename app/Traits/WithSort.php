<?php

namespace App\Traits;

trait WithSort
{
    public ?string $sortCol = null;
    public bool $sortAsc = false;

    public function sortBy($column): void
    {
        if ($this->sortCol === $column) {
            if ($this->sortAsc) {
                $this->sortAsc = false;
            } else {
                $this->sortCol = null;
                $this->sortAsc = false;
            }
        } else {
            $this->sortCol = $column;
            $this->sortAsc = true;
        }

        $this->resetPage();
    }

    protected function sortableMap(): array
    {
        return [];
    }

    protected function sortableJoins(): array
    {
        return [];
    }

    protected function virtualSortFields(): array
    {
        return [];
    }

    protected function applySorting($query)
    {
        return \App\Builder\SortQueryBuilder::apply(
            $query,
            $this->sortCol,
            $this->sortAsc,
            $this->sortableMap(),
            $this->sortableJoins(),
            $this->virtualSortFields()
        );
    }

    protected function applyVirtualSorting($collection)
    {
        if (!in_array($this->sortCol, $this->virtualSortFields(), true)) {
            return $collection;
        }

        return $collection
            ->sortBy($this->sortCol, SORT_REGULAR, !$this->sortAsc)
            ->values();
    }
}
