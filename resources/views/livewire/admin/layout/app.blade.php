<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ Vite::asset('resources/images/favicon.ico') }}">
    <title>{{ config('app.name') }} | Admin @if (!empty($title))
            | {{ $title }}
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body x-data="{
    logoutPopup: false,
    sidebarMobile: false,
    sidebarOpen: window.innerWidth >= 768 ? (JSON.parse(localStorage.getItem('sidebarOpen')) ?? true) : false,
    screenWidth: window.innerWidth,
    popupOpen: false,
    get isMobile() { return this.screenWidth < 768 },
    init() {
        this.handleResize();
        window.addEventListener('resize', this.handleResize.bind(this));

        this.$el.addEventListener('open-popup', () => { this.popupOpen = true; });
        this.$el.addEventListener('close-popup', () => { this.popupOpen = false; });
    },
    handleResize() {
        this.screenWidth = window.innerWidth;
        if (this.screenWidth >= 768) {
            const savedState = JSON.parse(localStorage.getItem('sidebarOpen'));
            this.sidebarOpen = savedState !== null ? savedState : true;
            this.sidebarMobile = false;
            document.body.classList.remove('mobile-sopen');
        } else {
            this.sidebarOpen = false;
            if (this.sidebarMobile) {
                document.body.classList.add('mobile-sopen');
            } else {
                document.body.classList.remove('mobile-sopen');
            }
        }
    },
    toggleSidebar() {
        if (this.screenWidth >= 768) {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        } else {
            this.sidebarMobile = !this.sidebarMobile;
            if (this.sidebarMobile) {
                document.body.classList.add('mobile-sopen');
            } else {
                document.body.classList.remove('mobile-sopen');
            }
        }
    }
}" :class="{ 'sopen': sidebarOpen, 'sclose': !sidebarOpen, 'mobile-sopen': isMobile && sidebarMobile, 'popup-open': popupOpen }"
    class="flex flex-col md:h-screen group transition-all duration-300 [&.popup-open]:overflow-hidden [&.mobile-sopen]:overflow-hidden" x-cloak>
    <div class="flex md:flex-1 flex-col md:flex-row md:overflow-hidden">
        @livewire('admin.layout.sidebar')
        <!-- Main Content -->
        <main class="bg-[#FFFDF3] flex flex-col md:flex-1 h-full overflow-x-auto">
            @livewire('components.notification')

            @livewire('admin.layout.topbar')

            {{ $slot }}

            <x-logout />
        </main>
    </div>
    @livewire('admin.layout.footer')
    @livewireScripts
    @stack('scripts')
</body>

</html>
