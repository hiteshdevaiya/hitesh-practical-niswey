<div class="flex flex-col-reverse md:flex md:flex-row min-h-screen bg-[#FFFDF3]" x-cloak>
    <div class="w-full md:w-1/2 h-screen" x-cloak wire:ignore>
        <div class="login-image h-full">
            <x-img name="signin-banner.png" class="h-full w-full object-cover" />
        </div>
    </div>
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center py-5">
        <div class="text-center px-4 lg:px-0 w-full lg:w-[462px] overflow-y-auto">
            <h2 class="text-2xl lg:text-4xl font-semibold mb-1 lg:mb-3">Reset Password</h2>
            <p class="text-sm lg:text-lg text-[#707070] mb-4 lg:mb-8">Enter a new password to reset and secure your
                account.</p>
            <form wire:submit.prevent="resetPassword" class="space-y-4">
                <input type="hidden" wire:model="token">
                <input type="hidden" wire:model="email">
                <div class="text-left relative w-full" x-data="{ show: false }">
                    <x-label for="password" value="New Password" required="true" />
                    <div class="relative">
                        <x-input x-bind:type="show ? 'text' : 'password'" id="password" name="password" model="password"
                        placeholder="Enter Your New Password" @keydown.space.prevent maxlength="15" />
                        <x-password-toggle class="absolute right-3.5 bottom-[18px]" />
                    </div>
                    <x-error field="password" />
                </div>
                <div class="text-left relative w-full mb-6" x-data="{ show: false }">
                    <x-label for="password_confirmation" value="Confirm Password" required="true" />
                    <div class="relative">
                        <x-input x-bind:type="show ? 'text' : 'password'" id="password_confirmation"
                        name="password_confirmation" model="password_confirmation"
                        placeholder="Re-Enter Your New Password" @keydown.space.prevent maxlength="15" />
                        <x-password-toggle class="absolute right-3.5 bottom-[18px]" />
                    </div>
                    <x-error field="password_confirmation" />
                </div>
                <x-button class="w-full bg-[#FFCD05] font-medium text-base py-3.5 rounded-xl block cursor-pointer">
                    Save
                </x-button>
            </form>
        </div>
    </div>
</div>
