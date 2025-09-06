<div class="pt-4 pb-6 px-6 max-[767px]:px-4 h-[calc(100%-100.8px)] outer-tabs flex-1 overflow-y-auto">

    <x-breadcrumb :links="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Contact Management', 'url' => route('admin.contact.index')],
        ['label' => 'Add Contact', 'url' => null],
    ]" />

    <div class="border border-[#E7E7E7] rounded-xl bg-white h-[calc(100%-40px)] flex flex-col pb-8 overflow-y-auto">
        <div class="border-b border-[#E7E7E7] py-4 px-6 flex items-center">
            <a href="{{ route('admin.contact.index') }}" wire:navigate class="flex items-center">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="mr-2">
                    <path d="M12.5 5L7.5 10L12.5 15" stroke="#292929" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-lg font-bold mr-2">Add Contact</span>
            </a>
        </div>

        <div class="p-4">
            <form class="w-full" wire:submit.prevent="save" x-data x-cloak>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-6">
                    <div class="form-item text-left mb-4">
                        <x-label for="name" value="Name" required="true" />
                        <x-input type="text" id="name" name="name" model="name" placeholder="Enter Name" />
                        <x-error field="name" />
                    </div>

                    <div class="text-left w-full">
                        <x-label for="phone" value="Phone" required="true" />
                        <x-input type="text" id="phone" name="phone" model="phone" placeholder="Enter Phone With Dial Code" />
                        <x-error field="phone" />
                    </div>

                    <div class="form-item text-left mb-4">
                        <x-label for="email" value="Email" required="true" />
                        <x-input type="text" id="email" name="email" model="email" placeholder="Enter Email" />
                        <x-error field="email" />
                    </div>

                    <div class="form-item text-left mb-4">
                        <x-label for="address" value="Address" required="true" />
                        <x-input type="text" id="address" name="address" model="address" placeholder="Enter Address" />
                        <x-error field="address" />
                    </div>

                    <div class="form-item text-left mb-4"
                        x-data="{
                            fp: null,
                            initPicker() {
                                if (this.fp) {
                                    this.fp.destroy();
                                    this.fp = null;
                                }
                                this.fp = flatpickr(this.$refs.refInput, {
                                    dateFormat: '{{ config('constant.date_format_js') }}',
                                    allowInput: true,
                                    disableMobile: true,
                                    defaultDate: $wire.get('date') || null,
                                    onChange: (selectedDates, dateStr) => {
                                        $wire.set('date', dateStr, true);
                                    }
                                });
                            }
                        }"
                        x-init="initPicker()"
                        @reset-datepicker.window="initPicker()">
                        <x-label for="date" value="Birth Date" required="true" />
                        <x-input type="text" id="date" name="date" wire:model="date"
                            x-ref="refInput" class="text-base font-normal" placeholder="Select date" readonly />
                        <x-error field="date" />
                    </div>
                </div>

                <div class="form-item text-left mb-4">
                    {{-- Event Image --}}
                    <div x-data="{ uploading: false }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-error="uploading = false">

                        <div :class="{ 'uploading-state': uploading }"
                            class="file-upload-wrapper border border-[#E7E7E7] rounded-xl p-6 relative group {{ $image_preview ? 'file-added' : '' }} [&.file-added]:p-0">

                            <label class="file-upload-label block cursor-pointer {{ $image_preview ? 'hidden' : '' }}">
                                <div class="flex flex-col items-center justify-center px-6 py-12 max-[767px]:py-4 text-center">
                                    <svg width="90" height="91" viewBox="0 0 90 91" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="max-[767px]:w-[55px] max-[767px]:h-[55px] mb-1">
                                        <path
                                            d="M46.875 11.75H29.25C22.9494 11.75 19.7991 11.75 17.3926 12.9762C15.2758 14.0548 13.5548 15.7758 12.4762 17.8926C11.25 20.2991 11.25 23.4494 11.25 29.75V61.25C11.25 67.5508 11.25 70.7007 12.4762 73.1075C13.5548 75.2244 15.2758 76.9453 17.3926 78.0238C19.7991 79.25 22.9494 79.25 29.25 79.25H63.75C67.2375 79.25 68.9813 79.25 70.4119 78.8668C74.2939 77.8265 77.3265 74.7939 78.3668 70.9119C78.75 69.4813 78.75 67.7375 78.75 64.25M71.25 30.5V8M60 19.25H82.5M39.375 32.375C39.375 36.5171 36.0171 39.875 31.875 39.875C27.7329 39.875 24.375 36.5171 24.375 32.375C24.375 28.2329 27.7329 24.875 31.875 24.875C36.0171 24.875 39.375 28.2329 39.375 32.375ZM56.2125 45.1929L24.4918 74.03C22.7076 75.6522 21.8155 76.463 21.7366 77.1658C21.6682 77.7748 21.9017 78.3785 22.362 78.7831C22.8929 79.25 24.0986 79.25 26.5098 79.25H61.71C67.1066 79.25 69.8051 79.25 71.9246 78.3432C74.5852 77.2051 76.7051 75.0852 77.8432 72.4246C78.75 70.3051 78.75 67.6066 78.75 62.21C78.75 60.3939 78.75 59.486 78.5516 58.6407C78.3019 57.578 77.8237 56.5828 77.1499 55.724C76.6136 55.0408 75.9045 54.4734 74.4866 53.3394L63.9967 44.9476C62.5777 43.8121 61.8683 43.2444 61.0868 43.0441C60.3979 42.8675 59.6734 42.8904 58.9969 43.1101C58.2296 43.3591 57.5572 43.9704 56.2125 45.1929Z"
                                            stroke="#888888" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-xl leading-[normal] mb-1">
                                        <span class="text-xl font-medium max-[767px]:text-lg">Drop your image here</span>, or
                                        <span class="text-[#FFCD05] text-xl font-medium cursor-pointer hover:underline max-[767px]:text-lg">Browse</span>
                                    </p>
                                    <p class="text-base text-[#A0A0A0] leading-[normal] max-[767px]:text-sm">
                                        {{ config('media-library.allowed_extensions_label') }} (Max size {{ config('media-library.max_file_size_in_mb') }}MB)
                                    </p>
                                </div>
                                <input type="file" wire:model="image" accept="{{ config('media-library.allowed_extensions_html') }}" class="sr-only file-input" />
                            </label>

                            @if ($image_preview)
                                <div class="preview-container relative group/image_preview overflow-hidden">
                                    <div class="w-full h-[312px] max-[767px]:h-[255px]">
                                        <img src="{{ $image_preview }}" class="image-preview w-full h-full object-contain bg-[#f0f0f0] rounded-xl" />
                                    </div>
                                    <div class="bg-[rgba(0,0,0,0.6)] w-full h-full absolute left-0 top-0 z-[5] group-hover/image_preview:opacity-100 opacity-0 rounded-xl transition-all duration-300"></div>
                                    <div class="grid-cols-2 gap-x-4 group-hover/image_preview:grid hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                                        <label class="cursor-pointer">
                                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="48" height="48" rx="24" fill="white" />
                                                <path d="M14.8687 28.788L14 34L19.2121 ..." stroke="#292929" stroke-width="2" />
                                            </svg>
                                            <input type="file" wire:model="image" class="hidden" accept="{{ config('media-library.allowed_extensions_html') }}" />
                                        </label>
                                        <button type="button" wire:click="removeImage" class="cursor-pointer">
                                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="48" height="48" rx="24" fill="white" />
                                                <path d="M14 17.333H34" stroke="#EC1A1A" stroke-width="1.6" stroke-linecap="round" />
                                                <path d="M21.7773 22.8877V29.5544" stroke="#EC1A1A" stroke-width="1.6" />
                                                <path d="M26.2227 22.8877V29.5544" stroke="#EC1A1A" stroke-width="1.6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <x-error field="image" />
                    </div>
                </div>

                <div class="flex justify-end items-center">
                    <x-button wire:loading.attr="disabled" wire:target="image"
                        class="bg-[#FFCD05] border border-[#FFCD05] font-medium text-base py-3.5 px-4 rounded-xl cursor-pointer whitespace-nowrap w-[200px]">
                        Add
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
