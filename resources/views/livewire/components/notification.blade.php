<div x-data="{ show: @entangle('show'), message: @entangle('message'), type: @entangle('type') }" x-init="if (message) {
    show = true;
    setTimeout(() => show = false, 3000);
}"
    x-on:notify.window="
        message = $event.detail.payload.message;
        type = $event.detail.payload.type ?? 'success';
        show = true;
        setTimeout(() => show = false, 3000);
    "
    x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed top-4 right-4 z-[9999]" x-cloak>
    <div class="text-white px-6 py-4 rounded-lg shadow-lg flex items-center justify-between min-w-[300px]"
        :class="{
            'bg-green-500': type === 'success',
            'bg-red-500': type === 'error',
            'bg-yellow-500': type === 'warning',
            'bg-blue-500': type === 'info'
        }">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="message"></span>
        </div>
        <button @click="show = false" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
