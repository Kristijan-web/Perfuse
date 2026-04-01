<header class="border-b border-white/5 bg-[#0a0a0a] text-white">
    <div
        class="mx-auto flex min-h-[80px] max-w-[1680px] items-center justify-between gap-6 px-5 py-[18px] lg:px-[42px] lg:py-0">
        <a href="#" class="shrink-0 font-sans text-[22px] uppercase tracking-[0.08em] text-[#f5f1eb]">
            <span class="inline-flex items-center gap-3">
                <span>Exmoor</span>
                <span
                    class="inline-flex h-[38px] w-[38px] items-center justify-center rounded-full border-2 border-white/90 text-[18px] leading-none">
                    O
                </span>
            </span>
        </a>
        <nav class="flex flex-wrap items-center justify-end gap-x-6 gap-y-[18px] text-[16px] leading-none lg:gap-[34px]"
            aria-label="Main navigation">
            <a href="#" class="text-white transition-opacity duration-200 hover:opacity-75">Po&ccaron;etna</a>
            <a href="#" class="text-white transition-opacity duration-200 hover:opacity-75">Shop</a>
            <a href="#" class="text-white transition-opacity duration-200 hover:opacity-75">Kontakt</a>

            <a href="#"
                class="inline-flex items-center gap-[10px] text-white transition-opacity duration-200 hover:opacity-75">
                <svg class="h-[19px] w-[19px] shrink-0 fill-none stroke-current stroke-[1.8]" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <circle cx="9" cy="20" r="1.25"></circle>
                    <circle cx="18" cy="20" r="1.25"></circle>
                    <path d="M3 4h2.2l2.4 10.2h10.1l2.1-7.1H7.2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Korpa</span>
            </a>

            {{-- // sad sintaksa da se ode na login --}}
            <a href="{{ route('registerPage') }}"
                class="inline-flex items-center gap-[10px] text-white  decoration-white  transition-opacity duration-200 hover:opacity-75">
                {{-- <svg class="h-[19px] w-[19px] shrink-0 fill-none stroke-current stroke-[1.8]" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 20c1.6-4 5-6 8-6s6.4 2 8 6" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg> --}}
                <span>Register</span>
            </a>
            <a href="{{ route('loginPage') }}"
                class="inline-flex items-center gap-[10px] text-white  decoration-white  transition-opacity duration-200 hover:opacity-75">
                {{-- <svg class="h-[19px] w-[19px] shrink-0 fill-none stroke-current stroke-[1.8]" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 20c1.6-4 5-6 8-6s6.4 2 8 6" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg> --}}
                <span>Login</span>
            </a>
        </nav>
    </div>
</header>