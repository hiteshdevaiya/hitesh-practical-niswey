@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();

        // Determine which pages to show
        $showPages = [];
        $showPages[] = 1; // Always show first page

        // Show pages around current page
        $range = 1; // Number of pages to show around current page
        $start = max(2, $currentPage - $range);
        $end = min($lastPage - 1, $currentPage + $range);

        for ($i = $start; $i <= $end; $i++) {
            $showPages[] = $i;
        }

        // Always show last page
        $showPages[] = $lastPage;

        // Remove duplicates and sort
        $showPages = array_unique($showPages);
        sort($showPages);
    @endphp

    <ul class="flex items-center">
        {{-- First Page --}}
        <li class="dt-paging-button page-item mr-1 flex items-center justify-center ">
            <button
                class="page-link text-base font-medium
                {{ $paginator->onFirstPage()
                    ? 'text-gray-500 cursor-not-allowed pointer-events-none'
                    : 'bg-white text-black hover:bg-[#FFCD05] cursor-pointer' }}"
                wire:click="gotoPage(1)"
                onclick="document.querySelector('.overflow-auto table').scrollIntoView({ behavior: 'smooth' })"
                @disabled($paginator->onFirstPage())>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="max-[767px]:h-[14px] max-[767px]:w-[14px]">
                    <path
                        d="M12 19.75c-.192 0-.384-.073-.53-.22L4.47 12.53a.75.75 0 0 1 0-1.06l7-7a.75.75 0 1 1 1.06 1.06L6.06 12l6.47 6.47a.75.75 0 0 1-.53 1.28Zm7.53-.22a.75.75 0 0 0 0-1.06L13.06 12l6.47-6.47a.75.75 0 1 0-1.06-1.06l-7 7a.75.75 0 0 0 0 1.06l7 7a.75.75 0 0 0 1.06 0Z"
                        fill="currentColor" />
                </svg>
            </button>
        </li>

        {{-- Previous Page --}}
        <li class="dt-paging-button page-item mr-1 flex items-center justify-center">
            <button
                class="page-link text-base font-medium
                {{ $paginator->onFirstPage()
                    ? 'text-gray-500 cursor-not-allowed pointer-events-none'
                    : 'bg-white text-black hover:bg-[#FFCD05] cursor-pointer' }}"
                wire:click="previousPage"
                onclick="document.querySelector('.overflow-auto table').scrollIntoView({ behavior: 'smooth' })"
                @disabled($paginator->onFirstPage())>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="max-[767px]:h-[14px] max-[767px]:w-[14px]">
                    <path
                        d="M15 19.75a.75.75 0 0 0 .53-1.28L9.06 12l6.47-6.47a.75.75 0 0 0-1.06-1.06l-7 7a.75.75 0 0 0 0 1.06l7 7a.75.75 0 0 0 .53.22Z"
                        fill="currentColor" />
                </svg>
            </button>
        </li>

        <div class="flex items-center">
            @foreach ($showPages as $index => $page)
                {{-- Add ellipsis when there's a gap between page numbers --}}
                @if ($index > 0 && ($showPages[$index] - $showPages[$index - 1] > 1))
                    <li class="page-item disabled max-[767px]:-ml-2.5"><span class="page-link text-gray-400 px-2">...</span></li>
                @endif

                <li class="dt-paging-button page-item max-[767px]:h-[28px] h-[32px] mr-2.5 last:mr-0 group">
                    <button
                        wire:click="gotoPage({{ $page }})"
                        onclick="document.querySelector('.overflow-auto table').scrollIntoView({ behavior: 'smooth' })"
                        class="page-link transition-all duration-300 ease-in-out max-[767px]:px-2 max-[767px]:text-xs px-3 rounded-sm text-base font-medium w-full h-[inherit]
                            {{ $page == $currentPage
                                ? 'bg-[#FFCD05] text-black cursor-default pointer-events-none'
                                : 'bg-[#EBECEF] text-gray-700 hover:bg-[#FFCD05] hover:text-black cursor-pointer' }}"
                        aria-current="{{ $page == $currentPage ? 'page' : '' }}">
                        {{ $page }}
                    </button>
                </li>
            @endforeach
        </div>

        {{-- Next Page --}}
        <li class="dt-paging-button page-item ml-1 flex items-center justify-center">
            <button
                class="page-link text-base font-medium
                {{ !$paginator->hasMorePages()
                    ? 'text-gray-500 cursor-not-allowed pointer-events-none'
                    : 'bg-white text-black hover:bg-[#FFCD05] cursor-pointer' }}"
                wire:click="nextPage"
                onclick="document.querySelector('.overflow-auto table').scrollIntoView({ behavior: 'smooth' })"
                @disabled(!$paginator->hasMorePages())>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="max-[767px]:h-[14px] max-[767px]:w-[14px]">
                    <path
                        d="M9 19.75a.75.75 0 0 1-.53-1.28L14.94 12 8.47 5.53a.75.75 0 1 1 1.06-1.06l7 7a.75.75 0 0 1 0 1.06l-7 7a.75.75 0 0 1-.53.22Z"
                        fill="currentColor" />
                </svg>
            </button>
        </li>

        {{-- Last Page --}}
        <li class="dt-paging-button page-item ml-1 flex items-center justify-center">
            <button
                class="page-link text-base font-medium
                {{ !$paginator->hasMorePages()
                    ? 'text-gray-500 cursor-not-allowed pointer-events-none'
                    : 'bg-white text-black hover:bg-[#FFCD05] cursor-pointer' }}"
                wire:click="gotoPage({{ $paginator->lastPage() }})"
                onclick="document.querySelector('.overflow-auto table').scrollIntoView({ behavior: 'smooth' })"
                @disabled(!$paginator->hasMorePages())>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="max-[767px]:h-[14px] max-[767px]:w-[14px]">
                    <path
                        d="M19.53 12.53a.75.75 0 0 0 0-1.06l-7-7a.75.75 0 0 0-1.06 1.06L17.94 12l-6.47 6.47a.75.75 0 0 0 1.06 1.06l7-7Zm-7-1.06-7-7a.75.75 0 1 0-1.06 1.06L10.94 12 4.47 18.47a.75.75 0 1 0 1.06 1.06l7-7a.75.75 0 0 0 0-1.06Z"
                        fill="currentColor" />
                </svg>
            </button>
        </li>
    </ul>
@endif
