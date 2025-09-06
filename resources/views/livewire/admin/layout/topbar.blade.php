<div>
    <header
        class="p-4 lg:p-6 border-b border-[rgba(255,205,5,0.3)] md:h-[70.8px] lg:h-[80.6px] xl:h-[90.7px] 2xl:h-[100.8px] flex flex-col-reverse md:flex-row justify-between items-center bg-white space-x-2.5">
        <div class="flex items-center">
            <button @click="toggleSidebar" class="hidden md:block text-gray-700 mr-3 cursor-pointer">
                <!-- Hamburger Icon -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="flex items-center mb-4 md:mb-0 w-full md:w-auto">
            <div
                class="py-2.5 text-xl font-semibold border-b border-[rgba(255,205,5,0.3)] text-center block md:hidden max-[767px]:mr-auto">
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="block">
                    <x-img name="logo.svg"
                        class="mx-auto w-[40px] h-[40px] xl:w-[60px] xl:h-[60px] 2xl:w-[80px] 2xl:h-[80px]" />
                </a>
            </div>
            {{-- <a href="#"
                class="pr-2 -mr-1.5 md:pr-4 md:mr-4 relative after:content-[''] after:w-[1px] after:h-3 after:bg-[#58584C] after:absolute after:right-0 after:top-1/2 after:transform after:-translate-y-1/2">
                <x-img name="notification-icon.svg"
                    class="w-[40px] h-[40px] xl:w-[42px] xl:h-[42px] 2xl:w-[52px] 2xl:h-[52px] max-[767px]:ml-auto" />
                <p
                    class="bg-[#FFCD05] p-1 rounded-full text-[10px] font-semibold w-[18px] h-[18px] flex items-center justify-center absolute -top-1.5 right-1.5 md:-top-1.5 md:right-3.5">
                    5</p>
            </a> --}}
            <div x-data="{ open: false }" @click.away="open = false"
                class="flex items-center cursor-pointer relative max-[767px]:ml-3" @click="open = !open">
                <img src="{{ $admin->profile_picture }}" width="52" height="52" alt="LoggedIn User" x-cloak
                    class="rounded-[50%] border border-[#58584C] mr-1.5 xl:mr-3 w-[40px] h-[40px] xl:h-[42px] 2xl:w-[52px] 2xl:h-[52px]" />
                <p class="flex items-center text-xs md:text-sm xl:text-base">{{ $admin->name }}<span
                        class="w-6 h-6 ml-0.5 xl:ml-1 flex justify-center items-center"><img
                            src="{{ Vite::asset('resources/images/dropdown-icon.svg') }}" width="14" height="8"
                            alt="Dropdown" /></span></p>
                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2" x-cloak
                    class="absolute top-full left-0 right-0 px-3 py-1 z-10 bg-white rounded-lg shadow-[-2px_2px_12px_0px_rgba(0,0,0,0.06)]">
                    <li>
                        <a href="#" @click.prevent="logoutPopup = true; $dispatch('open-popup')"
                            class="flex items-center py-4 group/submenu hover:text-[#FFCD05] transition-all duration-300">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="mr-1.5">
                                <path
                                    d="M11.6667 2.57918C11.2858 2.52701 10.8963 2.5 10.5 2.5C6.08173 2.5 2.5 5.85787 2.5 10C2.5 14.1422 6.08173 17.5 10.5 17.5C10.8963 17.5 11.2858 17.473 11.6667 17.4208"
                                    stroke="#292929"
                                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300"
                                    stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M17.4998 10.0003H9.1665M17.4998 10.0003C17.4998 9.41683 15.8379 8.3266 15.4165 7.91699M17.4998 10.0003C17.4998 10.5838 15.8379 11.6741 15.4165 12.0837"
                                    stroke="#292929"
                                    class="group-hover/submenu:stroke-[#FFCD05] transition-all duration-300"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button @click="sidebarMobile = true" class="md:hidden text-gray-700 max-[767px]:ml-3">
                <!-- Hamburger Icon -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <div x-show="sidebarMobile && isMobile" x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarMobile = false"
        class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden" x-cloak>
    </div>
</div>
