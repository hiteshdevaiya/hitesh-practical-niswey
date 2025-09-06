<div class="flex flex-col-reverse md:flex md:flex-row min-h-screen bg-[#FFFDF3]" x-cloak>
    <div class="w-full md:w-1/2 h-screen" x-cloak wire:ignore>
        <div class="login-image h-full">
            <x-img name="signin-banner.png" class="h-full w-full object-cover" />
        </div>
    </div>
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center py-5">
        <div class="text-center px-4 lg:px-0 w-full lg:w-[462px] overflow-y-auto">
            <h2 class="text-2xl lg:text-4xl font-semibold mb-1 lg:mb-3">Sign In to your Account</h2>
            <p class="text-sm lg:text-lg text-[#707070] mb-4 lg:mb-8">Welcome back! please enter your detail</p>
            <form wire:submit.prevent="login" class="space-y-4">
                <div class="text-left w-full">
                    <x-label for="email" value="Email" required="true" />
                    <x-input type="text" id="email" name="email" model="email"
                        placeholder="Enter Your Email"
                        novalidate x-on:invalid="event.preventDefault()" />
                    <x-error field="email" />
                </div>
                <div class="text-left w-full" x-data="{ show: false }">
                    <x-label for="password" value="Password" required="true" />
                    <div class="relative">
                        <x-input x-bind:type="show ? 'text' : 'password'" id="password" name="password" model="password"
                        placeholder="Enter Password" @keydown.space.prevent maxlength="15" />
                        <x-password-toggle class="absolute right-3.5 bottom-[18px]" />
                    </div>
                    <x-error field="password" />
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="remember" class="peer hidden" />
                        <div
                            class="checkmark w-5 h-5 lg:w-6 lg:h-6 border border-1 border-[#E7E7E7] bg-white rounded-md flex items-center justify-center peer-checked:border-[#FFCD05]">
                            <svg class="hidden w-5 h-5 lg:w-6 lg:h-6" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_8338_82666)">
                                    <path
                                        d="M6.40039 0.900391H17.5996C18.7346 0.900391 19.5324 0.900364 20.1543 0.951172C20.6887 0.994857 21.0328 1.07248 21.2979 1.18652L21.4072 1.23828C21.9176 1.49831 22.3448 1.89335 22.6426 2.37891L22.7617 2.59277C22.9043 2.87251 22.9989 3.23458 23.0488 3.8457C23.0996 4.46756 23.0996 5.26543 23.0996 6.40039V17.5996C23.0996 18.7346 23.0996 19.5325 23.0488 20.1543C23.0051 20.6887 22.9275 21.0328 22.8135 21.2979L22.7617 21.4072C22.5017 21.9176 22.1066 22.3448 21.6211 22.6426L21.4072 22.7617C21.1274 22.9043 20.7654 22.9989 20.1543 23.0488C19.5325 23.0996 18.7346 23.0996 17.5996 23.0996H6.40039C5.26543 23.0996 4.46756 23.0996 3.8457 23.0488C3.31124 23.0051 2.96718 22.9275 2.70215 22.8135L2.59277 22.7617C2.08242 22.5017 1.65526 22.1066 1.35742 21.6211L1.23828 21.4072C1.09573 21.1274 1.00113 20.7654 0.951172 20.1543C0.900364 19.5324 0.900391 18.7346 0.900391 17.5996V6.40039C0.900391 5.26543 0.900364 4.46756 0.951172 3.8457C0.994861 3.31124 1.07249 2.96718 1.18652 2.70215L1.23828 2.59277C1.49831 2.08245 1.89338 1.65526 2.37891 1.35742L2.59277 1.23828C2.87252 1.09574 3.23457 1.00113 3.8457 0.951172C4.46756 0.900364 5.26543 0.900391 6.40039 0.900391Z"
                                        fill="#FFCD05" stroke="#FFCD05" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M6 12L10 16L18 8" stroke="#292929" stroke-width="2.16"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_8338_82666">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <span class="ml-2 text-sm lg:text-base">Remember me</span>
                    </label>
                    <x-link href="{{ route('admin.password.request') }}" class="text-sm lg:text-base font-medium">
                        Forgot Password?
                    </x-link>
                </div>
                <x-button class="w-full bg-[#FFCD05] font-medium text-base py-3.5 rounded-xl block cursor-pointer">
                    Login
                </x-button>
            </form>
        </div>
    </div>
</div>
