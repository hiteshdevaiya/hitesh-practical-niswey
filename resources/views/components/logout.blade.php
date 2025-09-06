<div x-show="logoutPopup" x-cloak class="fixed inset-0 z-50 px-3 md:px-0 overflow-y-auto" x-transition>
    <div class="fixed inset-0 bg-[#111827] opacity-50 z-40"></div>
    <div class="flex items-start md:items-center justify-center min-h-full py-10 relative z-50">
        <div
            class="bg-white rounded-2xl py-6 px-6 2xl:px-10 max-w-[300px] 2xl:max-w-[444px] mx-auto w-full relative text-center">

            <h2 class="text-sm lg:text-base 2xl:text-2xl font-semibold mb-3">
                Are you sure want to<br>logout?
            </h2>
            <div class="flex items-center justify-between space-x-4">
                <x-button type="button" @click="logoutPopup = false; $dispatch('close-popup')"
                    class="w-1/3 xl:w-1/2 bg-white border border-[#CFCFCF] font-medium text-base py-2.5 2xl:py-3.5 rounded-xl">
                    Cancel
                </x-button>
                <form method="POST" action="{{ route('admin.logout') }}" class="w-1/3 xl:w-1/2">
                    @csrf
                    <x-button
                        class="w-full bg-[#FFCD05] border border-[#FFCD05] font-medium text-base py-2.5 2xl:py-3.5 rounded-xl">
                        Logout
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</div>
