@props([
    'rowId' => '',
    'onView' => null,
    'onEdit' => null,
    'onDelete' => null,
    'onPrimary' => null,
    'onApprove' => null,
    'onReject' => null,
])

<div class="flex justify-center space-x-2">
    {{-- View --}}
    @if ($onView)
        <a href="{!! $onView !!}" wire:navigate
            onclick="handleActionClick(event, 'dropdown-menu-{{ $rowId }}')"
            class="p-2 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-[#FFCD05] hover:text-white transition">
            <!-- Eye Icon -->
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300">
                <!-- Main eye shape -->
                <path
                    d="M10 4.375C5.625 4.375 3.125 7.5 1.875 10C3.125 12.5 5.625 15.625 10 15.625C14.375 15.625 16.875 12.5 18.125 10C16.875 7.5 14.375 4.375 10 4.375Z"
                    stroke="#292929" class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <!-- Eye pupil (optional) -->
                <circle class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" cx="10"
                    cy="10" r="2.5" stroke="#292929" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    @endif

    {{-- Edit --}}
    @if ($onEdit)
        <a
            @if (Str::startsWith($onEdit, 'js:'))
            @php $onEdit = Str::replaceFirst('js:', '', $onEdit); @endphp
            href="#"
                @click="$dispatch('open-popup')"
                onclick="handleActionClick(event, () => { {{ $onEdit }} })"
            @else
                href="{!! $onEdit !!}"
                wire:navigate
                onclick="handleActionClick(event, 'dropdown-menu-{{ $rowId }}')"
            @endif
            class="p-2 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-[#FFCD05] hover:text-white transition">
            <!-- Pencil Icon -->
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="group-hover/submenu:stroke-[rgb(255,205,5)] transition-all duration-300">
                <path
                    d="M3.15151 13.591L2.5 17.5L6.40905 16.8485C7.08787 16.7354 7.71437 16.413 8.20099 15.9263L17.0165 7.11073C17.6612 6.46601 17.6612 5.42075 17.0164 4.77605L15.2239 2.98353C14.5792 2.33881 13.5338 2.33882 12.8891 2.98356L4.07367 11.7992C3.58706 12.2857 3.26464 12.9122 3.15151 13.591Z"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" stroke="#292929"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.6665 5L14.9998 8.33333"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" stroke="#292929"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    @endif

    {{-- Primary --}}
    @if ($onPrimary)
        <a href="#" @click="$dispatch('open-popup')"
            onclick="handleActionClick(event, () => { {{ $onPrimary }} })"
            class="p-2 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-[#FFCD05] hover:text-white transition">
            <!-- Primary Icon -->
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.6667 2.57918C11.2858 2.52701 10.8963 2.5 10.5 2.5C6.08173 2.5 2.5 5.85787 2.5 10C2.5 14.1422 6.08173 17.5 10.5 17.5C10.8963 17.5 11.2858 17.473 11.6667 17.4208"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" stroke="#292929"
                    stroke-width="1.5" stroke-linecap="round" />
                <path
                    d="M17.4998 10.0013H9.1665M17.4998 10.0013C17.4998 9.4178 15.8379 8.32758 15.4165 7.91797M17.4998 10.0013C17.4998 10.5848 15.8379 11.6751 15.4165 12.0846"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" stroke="#292929"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    @endif

    {{-- Approve --}}
    @if ($onApprove)
        <a href="#" @click="$dispatch('open-popup')"
            onclick="handleActionClick(event, () => { {{ $onApprove }} })"
            class="p-2 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-[#FFCD05] hover:text-white transition">
            <!-- Approve Icon -->
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5 10.5L8.33333 13.8333L15 7.16667"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300"
                    stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    @endif

    {{-- Reject --}}
    @if ($onReject)
        <a href="#" @click="$dispatch('open-popup')"
            onclick="handleActionClick(event, () => { {{ $onReject }} })"
            class="p-2 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-[#FF0000] hover:text-white transition">
            <!-- Reject Icon -->
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 6L14 14M14 6L6 14"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300"
                    stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    @endif

    {{-- Download --}}
    {{-- @if ($onDownload)
        <a href="#" @click="$dispatch('open-popup')"
            onclick="handleActionClick(event, () => { {{ $onReject }} })"
            class="p-2 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-[#FF0000] hover:text-white transition">
            <!-- Reject Icon -->
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 6L14 14M14 6L6 14"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300"
                    stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    @endif --}}

    {{-- Delete --}}
    @if ($onDelete)
        <a href="#" @click="$dispatch('open-popup')"
            onclick="handleActionClick(event, () => { {{ $onDelete }} })"
            class="p-2 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-[#FF0000] hover:text-white transition">
            <!-- Trash Icon -->
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.5 5H4.16667H17.5" class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300"
                    stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M15.8337 4.99935V16.666C15.8337 17.108 15.6581 17.532 15.3455 17.8445C15.0329 18.1571 14.609 18.3327 14.167 18.3327H5.83366C5.39163 18.3327 4.96771 18.1571 4.65515 17.8445C4.34259 17.532 4.16699 17.108 4.16699 16.666V4.99935M6.66699 4.99935V3.33268C6.66699 2.89065 6.84259 2.46673 7.15515 2.15417C7.46771 1.84161 7.89163 1.66602 8.33366 1.66602H11.667C12.109 1.66602 12.5329 1.84161 12.8455 2.15417C13.1581 2.46673 13.3337 2.89065 13.3337 3.33268V4.99935"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" stroke="#292929"
                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.33301 9.16602V14.166"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" stroke="#292929"
                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.667 9.16602V14.166"
                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300" stroke="#292929"
                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    @endif
</div>

@once
    <script>
        window.handleActionClick = (event, callback) => {
            event.stopPropagation();
            if (typeof callback === 'function') callback();
        };
    </script>
@endonce
