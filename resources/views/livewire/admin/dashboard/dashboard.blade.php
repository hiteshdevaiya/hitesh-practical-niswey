<div class="pt-4 pb-6 px-6 max-[767px]:px-4 h-[calc(100%-100.8px)] outer-tabs flex-1 overflow-y-auto"
    x-data="{
        activeTab: @entangle('activeTab'),
        setTab(tab) {
            this.activeTab = tab;
            $wire.updateTab(tab);
        },
    }">

    <div class="pb-4 flex items-start justify-between flex-col xl:flex-row xl:items-center">
        <h1 class="text-sm xl:text-base 2xl:text-xl font-semibold flex items-center mb-2 xl:mb-0">Welcome Back <span
                class="ml-1">{{ $admin->name }}</span><x-img name="welcome-emoji.svg" class="ml-1" /></h1>
        <div id="tab-wrapper"
            class="flex max-[767px]:grid max-[767px]:grid-cols-4 max-[991px]:space-x-2 space-x-4 relative [&.clicked]:max-[767px]:pb-2.5 [&.clicked]:max-[767px]:mb-9">

            <template x-for="tab in ['weekly', 'monthly', 'yearly', 'custom']" :key="tab">
                <button @click="setTab(tab)"
                    class="outer-tab-btn bg-white border border-[#D8D7D7] rounded-md text-[#282828] text-sm xl:text-[15px] 2xl:text-base max-[991px]:text-sm font-medium px-3.5 max-[991px]:px-2.5 py-2.5 cursor-pointer [&.active]:bg-[#FFCD05] [&.active]:border-[#FFCD05] hover:bg-[#FFCD05] hover:border-[#FFCD05] transition-all duration-300 ease max-[767px]:w-[70px]"
                    :class="{
                        'active': activeTab === tab
                    }"
                    x-text="tab.charAt(0).toUpperCase() + tab.slice(1)">
                </button>
            </template>
            <!-- Datepicker -->

            {{-- bg-white border border-[#D8D7D7] rounded-md text-[#282828] text-sm xl:text-[15px] 2xl:text-base max-[991px]:text-sm font-medium max-[991px]:px-1.5 px-3.5 py-2.5 cursor-pointer [&.active]:bg-[#FFCD05] [&.active]:border-[#FFCD05] hover:bg-[#FFCD05] hover:border-[#FFCD05] transition-all duration-300 ease opacity-100 --}}

            <div id="date-display-wrapper" x-show="activeTab === 'custom'" x-transition
                class="relative z-10 ml-4 max-[991px]:ml-2 max-[767px]:ml-0 max-[767px]:left-0 max-[767px]:right-0 max-[767px]:mt-2 max-[767px]:w-full max-[767px]:col-span-4"
                x-data="{
                    fp: null,
                    initPicker() {
                        if (this.fp) {
                            this.fp.destroy();
                            this.fp = null;
                        }

                        this.fp = flatpickr(this.$refs.customRange, {
                            mode: 'range',
                            dateFormat: 'd/m/Y',
                            allowInput: true,
                            disableMobile: true,
                            defaultDate: $wire.get('custom_range') || null,
                            onChange: (selectedDates, dateStr) => {
                                $wire.set('custom_range', dateStr, true);
                                setTab('custom');
                            }
                        });
                    }
                }" x-init="initPicker()" @reset-datepicker.window="initPicker()">

                <input type="text" id="custom_range" name="custom_range" wire:model="custom_range"
                    x-ref="customRange"
                    class="pl-2.5 py-2.5 placeholder-[#A0A0A0] bg-white border border-[rgba(41,41,41,0.2)] rounded-md pr-10 focus:outline-none w-full text-base font-normal"
                    placeholder="Select custom date range" readonly />
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-[#E7E7E7] rounded-xl p-4">
            <div class="flex justify-between items-start mb-3">
                <svg width="44" height="44" viewBox="0 0 44 44"
                    class="w-[35px] h-[35px] 2xl:w-[44px] 2xl:h-[44px]" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 8C0 3.58172 3.58172 0 8 0H36C40.4183 0 44 3.58172 44 8V36C44 40.4183 40.4183 44 36 44H8C3.58172 44 0 40.4183 0 36V8Z"
                        fill="#FF9F29" fill-opacity="0.15" />
                    <path
                        d="M8 0.5H36C40.1421 0.5 43.5 3.85786 43.5 8V36C43.5 40.1421 40.1421 43.5 36 43.5H8C3.85786 43.5 0.5 40.1421 0.5 36V8C0.5 3.85786 3.85786 0.5 8 0.5Z"
                        stroke="#CCCCCC" stroke-opacity="0.25" />
                    <path
                        d="M21.9435 24.7509C25.6606 24.7509 28.8345 25.3402 28.8345 27.6984C28.8345 30.0556 25.681 30.6663 21.9435 30.6663C18.2264 30.6663 15.0525 30.077 15.0525 27.7199C15.0525 25.3617 18.206 24.7509 21.9435 24.7509ZM27.8867 23.331C29.3078 23.3046 30.8356 23.4997 31.4001 23.6383C32.5961 23.8734 33.3828 24.3534 33.7087 25.051C33.9842 25.6238 33.9842 26.2882 33.7087 26.8599C33.2102 27.9419 31.6028 28.2892 30.9781 28.379C30.8491 28.3985 30.7453 28.2863 30.7589 28.1566C31.0781 25.1584 28.5395 23.7368 27.8828 23.41C27.8547 23.3954 27.8489 23.3729 27.8518 23.3593C27.8537 23.3495 27.8654 23.3339 27.8867 23.331ZM16.1114 23.3313C16.1328 23.3343 16.1434 23.3499 16.1454 23.3587C16.1483 23.3733 16.1425 23.3948 16.1153 23.4104C15.4576 23.7372 12.9191 25.1588 13.2382 28.156C13.2518 28.2867 13.149 28.3979 13.02 28.3794C12.3953 28.2896 10.788 27.9423 10.2894 26.8603C10.0129 26.2876 10.0129 25.6241 10.2894 25.0514C10.6153 24.3538 11.401 23.8738 12.597 23.6377C13.1626 23.5001 14.6894 23.305 16.1114 23.3313ZM21.9435 13.333C24.4743 13.333 26.5035 15.3721 26.5035 17.9186C26.5035 20.4641 24.4743 22.5052 21.9435 22.5052C19.4127 22.5052 17.3834 20.4641 17.3834 17.9186C17.3834 15.3721 19.4127 13.333 21.9435 13.333ZM28.134 14.0977C30.5785 14.0977 32.4982 16.411 31.8444 18.9877C31.403 20.7224 29.8054 21.8747 28.0254 21.8279C27.8469 21.823 27.6713 21.8064 27.5016 21.7771C27.3784 21.7557 27.3163 21.6161 27.3862 21.5127C28.0652 20.5078 28.4522 19.299 28.4522 18.0013C28.4522 16.6471 28.0293 15.3846 27.295 14.3494C27.2717 14.3173 27.2542 14.2675 27.2775 14.2304C27.2969 14.2002 27.3328 14.1846 27.3668 14.1768C27.6141 14.126 27.8683 14.0977 28.134 14.0977ZM15.8626 14.0976C16.1284 14.0976 16.3826 14.1259 16.6309 14.1767C16.6639 14.1845 16.7007 14.2011 16.7201 14.2303C16.7424 14.2674 16.7259 14.3172 16.7027 14.3493C15.9684 15.3845 15.5454 16.647 15.5454 18.0012C15.5454 19.2989 15.9325 20.5077 16.6115 21.5126C16.6813 21.616 16.6192 21.7556 16.496 21.777C16.3253 21.8073 16.1507 21.8229 15.9722 21.8278C14.1922 21.8746 12.5946 20.7223 12.1533 18.9876C11.4985 16.4109 13.4182 14.0976 15.8626 14.0976Z"
                        fill="#FF9F29" />
                </svg>
            </div>
            <p class="text-sm 2xl:text-base font-medium text-[#414141] mb-1">Total Contacts</p>
            <p class="text-sm xl:text-base 2xl:text-2xl font-semibold text-[#292929] mb-1">{{ $contacts }}</p>
        </div>
    </div>
</div>
