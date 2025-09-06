@props([
    'sortable' => true,
    'field' => null,
    'sortCol' => null,
    'sortAsc' => false,
])
@php
    $isSortable = filter_var($sortable, FILTER_VALIDATE_BOOLEAN);
    $isActiveSort = $isSortable && $field && $sortCol === $field;
@endphp
<th {{ $attributes->merge(['class' => 'px-6 py-2 text-sm font-medium']) }}
    @if ($isSortable && $field) wire:click="sortBy('{{ $field }}')" @endif>
    <p class="flex justify-between items-center gap-x-2">
        {{ $slot }}
        @if ($isSortable && $field)
            <span class="tab-sorting">
                @if ($isActiveSort)
                    @if ($sortAsc)
                        <svg class="sort-asc" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m3 8 4-4 4 4"></path>
                            <path d="M7 4v16"></path>
                            <path d="M11 12h4"></path>
                            <path d="M11 16h7"></path>
                            <path d="M11 20h10"></path>
                        </svg>
                    @else
                        <svg class="sort-desc" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 16 4 4 4-4"></path>
                            <path d="M7 20V4"></path>
                            <path d="M11 4h10"></path>
                            <path d="M11 8h7"></path>
                            <path d="M11 12h4"></path>
                        </svg>
                    @endif
                @else
                    <svg class="block clear-sort" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m3 8 4-4 4 4"></path>
                        <path d="m11 16-4 4-4-4"></path>
                        <path d="M7 4v16"></path>
                        <path d="M15 8h6"></path>
                        <path d="M15 16h6"></path>
                        <path d="M13 12h8"></path>
                    </svg>
                @endif
            </span>
        @endif
    </p>
</th>
