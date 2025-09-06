@props(['paginator'])

@if ($paginator->total() > 0)
    <div class="border-t border-[#E7E7E7] py-2 px-2 md:px-6 flex max-[1024px]:flex-col md:items-center md:justify-between">
        <div class="grid grid-cols-[51px_auto] md:flex items-center max-[1024px]:mb-3">
            <p class="text-base mr-3">Show</p>
            <select x-data @change="$wire.set('perPage', $event.target.value)"
                wire:model="perPage"
                class="text-sm font-medium block bg-white border border-[#E7E7E7] rounded-lg py-2.5 px-3 w-[83px] appearance-none focus:outline-0 pr-6">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <p class="text-base ml-3 max-[1024px]:col-span-2 max-[767px]:ml-0">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }}
                entries
            </p>
        </div>
        <div>
            {{ $paginator->links('components.pagination') }}
        </div>
    </div>
@endif
