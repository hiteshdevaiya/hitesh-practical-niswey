<div>
    <div class="flex flex-col-reverse md:flex md:flex-row min-h-screen bg-[#FFFDF3]" x-cloak>
        <div class="w-full md:w-1/2 h-screen" x-cloak wire:ignore>
            <div class="login-image h-full">
                <x-img name="signin-banner.png" class="h-full w-full object-cover" />
            </div>
        </div>
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center py-5">
            <div class="text-center px-4 lg:px-0 w-full lg:w-[462px] overflow-y-auto">
                <h2 class="text-2xl lg:text-4xl font-semibold mb-1 lg:mb-3">Forgot Password</h2>
                <p class="text-sm lg:text-lg text-[#707070] mb-4 lg:mb-8">Enter the email address associated with your
                    account and we will send you a link to reset your password.</p>
                <form wire:submit.prevent="sendResetLink" class="space-y-6 mb-6"
                    x-data="{ isThrottled: false, throttleTime: @js($throttleSeconds) * 1000 }"
                    x-on:handle-throttle.window="isThrottled = true; setTimeout(() => { isThrottled = false }, throttleTime)">
                    <div class="text-left w-full">
                        <x-label for="email" value="Email" required="true" />
                        <x-input type="text" id="email" name="email" model="email"
                            placeholder="Enter Your Email"/>
                        <x-error field="email" />
                        <!-- Throttle message for main form -->
                        <template x-if="isThrottled">
                            <p class="text-red-500 mb-4">
                                Please wait before retrying.
                            </p>
                        </template>
                    </div>
                    <x-button
                        class="w-full bg-[#FFCD05] font-medium text-base py-3.5 rounded-xl block"
                        wire:loading.attr="disabled"
                        x-bind:disabled="isThrottled"
                        x-bind:class="isThrottled ? 'opacity-50 cursor-not-allowed' : ''">
                        Get Reset Link
                    </x-button>
                </form>
                <x-link href="{{ route('admin.login') }}" class="text-sm font-bold">
                    Back to Sign In
                </x-link>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 z-50 px-3 md:px-0 overflow-y-auto" x-data="{
            open: false,
            isThrottled: false,
            throttleTime: @js($throttleSeconds) * 1000
        }"
        x-show="open"
        x-cloak
        x-on:show-success-modal.window="open = true"
        x-on:handle-throttle.window="isThrottled = true; setTimeout(() => { isThrottled = false }, throttleTime)"
        x-transition style="display: none;">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-[#111827] opacity-50 z-40"></div>
        <div class="flex items-start md:items-center justify-center min-h-full py-10 relative z-50">
            <div class="bg-white rounded-2xl py-6 px-10 max-w-[444px] mx-auto w-full relative text-center">
                <x-img name="logo.svg" class="mb-8 mx-auto" />
                <h2 class="text-2xl lg:text-2xl font-semibold mb-1 lg:mb-3">Verify your Email</h2>
                <p class="text-sm lg:text-base text-[#707070] mb-4 lg:mb-8">Thank you, check your email for instructions
                    to reset your password</p>

                <template x-if="isThrottled">
                    <p class="text-red-500 mb-4">
                        Please wait before retrying.
                    </p>
                </template>
                <x-error field="modal" />
                <x-button type="button" @click="open = false; $wire.clearValidationMessages()"
                    class="w-full bg-[#FFCD05] font-medium text-base py-3.5 rounded-xl block mb-8 cursor-pointer">
                    Done
                </x-button>
                <p>Don't receive an email?
                    <span wire:click="sendResetLink(true)"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        wire:target="sendResetLink"
                        x-bind:class="isThrottled ? 'opacity-50 cursor-not-allowed' : ''"
                        x-bind:disabled="isThrottled"
                        class="text-[#FFCD05] text-base font-bold cursor-pointer">
                        Resend
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
