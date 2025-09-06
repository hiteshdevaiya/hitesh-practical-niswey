<div class="flex items-center mb-4">
    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mr-2">
        <path
            d="M16.5 14.9724V8.45861C16.5 7.44948 16.0503 6.49375 15.2751 5.85544L11.1084 2.42446C9.88141 1.41407 8.11859 1.41408 6.89155 2.42446L2.72488 5.85544C1.9497 6.49375 1.5 7.44948 1.5 8.45861V14.9724C1.5 16.8286 2.99238 18.3333 4.83333 18.3333H13.1667C15.0076 18.3333 16.5 16.8286 16.5 14.9724Z"
            stroke="#292929" stroke-width="1.5" stroke-linejoin="round" />
    </svg>
    <ul class="grid grid-flow-col auto-cols-max items-center">
        @foreach ($links as $index => $link)
            @if ($link['url'])
                <li class="flex">
                    <a href="{{ $link['url'] }}" wire:navigate
                        class="text-xs md:text-sm font-medium relative after:content-[''] after:h-[2px] after:w-1.5 after:bg-[#292929] after:absolute after:right-0 after:top-1/2 after:transform after:-translate-y-1/2 pr-3 mr-1">
                        {{ $link['label'] }}
                    </a>
                </li>
            @else
                <li class="text-xs md:text-sm font-medium flex">
                    {{ $link['label'] }}
                </li>
            @endif
        @endforeach
    </ul>
</div>
