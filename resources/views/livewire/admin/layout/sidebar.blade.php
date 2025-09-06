<aside id="sidebar" x-show="sidebarMobile || !isMobile" :class="{ '-translate-x-full': !sidebarMobile && isMobile }"
    x-transition:enter="transition ease-in-out duration-200 transform" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-200 transform"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-ref="sidebar"
    class="w-full md:w-[212px] lg:w-[312px] bg-white border-r border-[rgba(255,205,5,0.3)] flex flex-col fixed top-0 left-0 transform transition-transform duration-300 h-dvh overflow-y-auto z-50 shadow-lg md:transform-none md:static md:h-auto md:overflow-auto md:shadow-none md:-translate-x-px md:group-[.sclose]:w-[70px] -translate-x-full">
    <div
        class="py-2.5 text-xl font-semibold border-b border-[rgba(255,205,5,0.3)] text-center hidden md:block xl:group-[.sclose]:h-[90.7px] 2xl:group-[.sclose]:h-[100.8px] xl:group-[.sclose]:flex xl:group-[.sclose]:items-center xl:group-[.sclose]:justify-center">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="block">

            <x-img name="logo.svg" class="mx-auto w-[50px] h-[50px] lg:w-[60px] lg:h-[60px] xl:w-[70px] xl:h-[70px] 2xl:w-[80px] 2xl:h-[80px] xl:group-[.sclose]:w-[50px] xl:group-[.sclose]:h-[50px]" />

        </a>
    </div>
    <button id="closeSidebar" @click="sidebarMobile = false" class="text-gray-600 p-2 max-[767px]:block hidden">
        <!-- Close Icon -->
        <svg class="w-5 h-5 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <nav x-init="$nextTick(() => {
        const active = $el.querySelector('a.active');
        if (active) {
            $el.scrollTo({
                top: active.offsetTop - ($el.clientHeight / 2) + (active.clientHeight / 2),
                behavior: 'smooth'
            });
        }
    })"
        class="flex-1 pt-4 pb-[30px] px-2 lg:px-4 overflow-y-auto space-y-2 md:group-[.sclose]:px-2 lg:group-[.sclose]:px-2 xl:group-[.sclose]:px-2 2xl:group-[.sclose]:px-1">
        <a href="{{ route('admin.dashboard') }}" wire:navigate
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }} text-xs lg:text-[12px] xl:text-[14px] 2xl:text-base rounded-xl hover:bg-[#FFFAE6] flex items-center py-3 pl-2 xl:pl-4 border border-white hover:border-[rgba(255,205,5,0.2)] hover:font-medium transition-all duration-300 ease group/menu [&.active]:bg-[#FFFAE6] [&.active]:border-[rgba(255,205,5,0.2)] [&.active]:font-medium md:group-[.sclose]:px-0 md:group-[.sclose]:justify-center">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="mr-2 md:group-[.sclose]:mr-0 icon-stroke">
                <g clip-path="url(#clip0_8249_36671)">
                    <path
                        d="M1.66675 4.99935C1.66675 3.428 1.66675 2.64232 2.15491 2.15417C2.64306 1.66602 3.42873 1.66602 5.00008 1.66602C6.57143 1.66602 7.35711 1.66602 7.84526 2.15417C8.33341 2.64232 8.33341 3.428 8.33341 4.99935V6.66601C8.33341 8.23736 8.33341 9.02301 7.84526 9.51118C7.35711 9.99935 6.57143 9.99935 5.00008 9.99935C3.42873 9.99935 2.64306 9.99935 2.15491 9.51118C1.66675 9.02301 1.66675 8.23736 1.66675 6.66601V4.99935Z"
                        stroke="#FFCD05" stroke-width="1.5"
                        class="group-hover/menu:stroke-[#292929] group-[&.active]/menu:stroke-[#292929]" />
                    <path
                        d="M1.66675 15.834C1.66675 15.0574 1.66675 14.6692 1.79361 14.3628C1.96277 13.9545 2.28723 13.63 2.69561 13.4608C3.0019 13.334 3.39018 13.334 4.16675 13.334H5.83341C6.60998 13.334 6.99826 13.334 7.30456 13.4608C7.71293 13.63 8.03739 13.9545 8.20655 14.3628C8.33341 14.6692 8.33341 15.0574 8.33341 15.834C8.33341 16.6106 8.33341 16.9988 8.20655 17.3052C8.03739 17.7135 7.71293 18.038 7.30456 18.2072C6.99826 18.334 6.60998 18.334 5.83341 18.334H4.16675C3.39018 18.334 3.0019 18.334 2.69561 18.2072C2.28723 18.038 1.96277 17.7135 1.79361 17.3052C1.66675 16.9988 1.66675 16.6106 1.66675 15.834Z"
                        stroke="#FFCD05" stroke-width="1.5"
                        class="group-hover/menu:stroke-[#292929] group-[&.active]/menu:stroke-[#292929]" />
                    <path
                        d="M11.6667 13.3333C11.6667 11.762 11.6667 10.9763 12.1549 10.4882C12.6431 10 13.4287 10 15.0001 10C16.5714 10 17.3571 10 17.8452 10.4882C18.3334 10.9763 18.3334 11.762 18.3334 13.3333V15C18.3334 16.5713 18.3334 17.357 17.8452 17.8452C17.3571 18.3333 16.5714 18.3333 15.0001 18.3333C13.4287 18.3333 12.6431 18.3333 12.1549 17.8452C11.6667 17.357 11.6667 16.5713 11.6667 15V13.3333Z"
                        stroke="#FFCD05" stroke-width="1.5"
                        class="group-hover/menu:stroke-[#292929] group-[&.active]/menu:stroke-[#292929]" />
                    <path
                        d="M11.6667 4.16602C11.6667 3.38945 11.6667 3.00117 11.7936 2.69487C11.9627 2.2865 12.2872 1.96204 12.6956 1.79288C13.0019 1.66602 13.3902 1.66602 14.1667 1.66602H15.8334C16.61 1.66602 16.9982 1.66602 17.3046 1.79288C17.7129 1.96204 18.0374 2.2865 18.2066 2.69487C18.3334 3.00117 18.3334 3.38945 18.3334 4.16602C18.3334 4.94258 18.3334 5.33087 18.2066 5.63716C18.0374 6.04553 17.7129 6.36999 17.3046 6.53915C16.9982 6.66602 16.61 6.66602 15.8334 6.66602H14.1667C13.3902 6.66602 13.0019 6.66602 12.6956 6.53915C12.2872 6.36999 11.9627 6.04553 11.7936 5.63716C11.6667 5.33087 11.6667 4.94258 11.6667 4.16602Z"
                        stroke="#FFCD05" stroke-width="1.5"
                        class="group-hover/menu:stroke-[#292929] group-[&.active]/menu:stroke-[#292929]" />
                </g>
                <defs>
                    <clipPath id="clip0_8249_36671">
                        <rect width="20" height="20" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span class="md:group-[.sclose]:hidden">Dashboard</span>
        </a>
        <a href="{{ route('admin.contact.index') }}" wire:navigate
            class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }} text-xs lg:text-[12px] xl:text-[14px] 2xl:text-base rounded-xl hover:bg-[#FFFAE6] flex items-center py-3 pl-2 xl:pl-4 border border-white hover:border-[rgba(255,205,5,0.2)] hover:font-medium transition-all duration-300 ease group/menu [&.active]:bg-[#FFFAE6] [&.active]:border-[rgba(255,205,5,0.2)] [&.active]:font-medium md:group-[.sclose]:px-0 md:group-[.sclose]:justify-center">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="mr-2 md:group-[.sclose]:mr-0">
                <path
                    d="M9.85748 9.63408C11.181 9.63408 12.327 9.15938 13.2635 8.22279C14.1998 7.28636 14.6747 6.14058 14.6747 4.81689C14.6747 3.49365 14.2 2.34771 13.2634 1.41098C12.3268 0.4747 11.1809 0 9.85748 0C8.53378 0 7.388 0.4747 6.45157 1.41113C5.51514 2.34756 5.04028 3.49349 5.04028 4.81689C5.04028 6.14058 5.51514 7.28652 6.45157 8.22295C7.38831 9.15922 8.53424 9.63408 9.85748 9.63408ZM7.28043 2.23983C7.99896 1.5213 8.84186 1.17203 9.85748 1.17203C10.873 1.17203 11.716 1.5213 12.4347 2.23983C13.1532 2.95852 13.5027 3.80157 13.5027 4.81689C13.5027 5.83251 13.1532 6.6754 12.4347 7.39409C11.716 8.11278 10.873 8.46205 9.85748 8.46205C8.84216 8.46205 7.99927 8.11263 7.28043 7.39409C6.56174 6.67555 6.21231 5.83251 6.21231 4.81689C6.21231 3.80157 6.56174 2.95852 7.28043 2.23983Z"
                    fill="#FFCD05" class="group-hover/menu:fill-[#292929] group-[&.active]/menu:fill-[#292929]" />
                <path
                    d="M18.2863 15.3784C18.2593 14.9887 18.2047 14.5636 18.1242 14.1146C18.0431 13.6624 17.9385 13.2348 17.8134 12.844C17.684 12.4401 17.5084 12.0413 17.291 11.6591C17.0656 11.2623 16.8007 10.9169 16.5034 10.6326C16.1926 10.3352 15.8121 10.0961 15.372 9.92169C14.9335 9.7482 14.4475 9.66031 13.9276 9.66031C13.7234 9.66031 13.526 9.74408 13.1447 9.99234C12.91 10.1454 12.6355 10.3224 12.3291 10.5182C12.0671 10.6851 11.7122 10.8415 11.2738 10.9831C10.8461 11.1215 10.4118 11.1917 9.98306 11.1917C9.5546 11.1917 9.12033 11.1215 8.69232 10.9831C8.25439 10.8416 7.89932 10.6852 7.63779 10.5183C7.33429 10.3244 7.05963 10.1474 6.82144 9.99219C6.44043 9.74393 6.24298 9.66016 6.03882 9.66016C5.5188 9.66016 5.03296 9.7482 4.59457 9.92184C4.15482 10.0959 3.77411 10.3351 3.46298 10.6327C3.16574 10.9172 2.90085 11.2625 2.67563 11.6591C2.4585 12.0413 2.28271 12.44 2.15332 12.8442C2.02835 13.235 1.92383 13.6624 1.84265 14.1146C1.76208 14.5629 1.70761 14.9882 1.6806 15.3788C1.65405 15.7608 1.64062 16.1583 1.64062 16.5599C1.64062 17.6039 1.9725 18.449 2.62695 19.0724C3.27332 19.6875 4.12842 19.9993 5.16861 19.9993H14.7987C15.8386 19.9993 16.6937 19.6875 17.3402 19.0724C17.9948 18.4495 18.3267 17.604 18.3267 16.5597C18.3266 16.1567 18.313 15.7592 18.2863 15.3784ZM16.5321 18.2232C16.105 18.6297 15.538 18.8273 14.7986 18.8273H5.16861C4.42902 18.8273 3.862 18.6297 3.43506 18.2234C3.0162 17.8247 2.81265 17.2804 2.81265 16.5599C2.81265 16.1851 2.82501 15.8151 2.84973 15.4599C2.87384 15.1113 2.92313 14.7285 2.99622 14.3217C3.06839 13.9199 3.16025 13.5429 3.2695 13.2016C3.37433 12.8743 3.5173 12.5502 3.69461 12.238C3.86383 11.9404 4.05853 11.6851 4.27338 11.4795C4.47433 11.287 4.72763 11.1296 5.02609 11.0115C5.30212 10.9022 5.61234 10.8424 5.9491 10.8334C5.99014 10.8552 6.06323 10.8969 6.18164 10.9741C6.42258 11.1311 6.70029 11.3102 7.00729 11.5063C7.35336 11.727 7.79922 11.9262 8.33191 12.0982C8.8765 12.2743 9.43192 12.3637 9.98322 12.3637C10.5345 12.3637 11.0901 12.2743 11.6344 12.0984C12.1675 11.9261 12.6132 11.727 12.9597 11.506C13.2739 11.3052 13.5439 11.1313 13.7848 10.9741C13.9032 10.897 13.9763 10.8552 14.0173 10.8334C14.3542 10.8424 14.6645 10.9022 14.9406 11.0115C15.239 11.1296 15.4922 11.2872 15.6932 11.4795C15.9081 11.685 16.1028 11.9403 16.272 12.2381C16.4494 12.5502 16.5926 12.8744 16.6972 13.2014C16.8066 13.5432 16.8987 13.9201 16.9707 14.3216C17.0436 14.7291 17.093 15.1121 17.1172 15.46V15.4603C17.142 15.8142 17.1545 16.184 17.1547 16.5599C17.1545 17.2805 16.951 17.8247 16.5321 18.2232Z"
                    fill="#FFCD05" class="group-hover/menu:fill-[#292929] group-[&.active]/menu:fill-[#292929]" />
            </svg>
            <span class="md:group-[.sclose]:hidden">Contact Management</span>
        </a>
    </nav>
</aside>
