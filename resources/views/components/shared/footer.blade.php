<footer class="bg-main-color-shade mt-20">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 py-12 sm:grid-cols-2 sm:px-10 lg:grid-cols-3 lg:px-12">
        <div class="text-secondary-color">
            <h4 class="mb-4 text-2xl font-semibold">Popularni linkovi</h4>
            <nav aria-label="Footer navigation">
                <ul class="space-y-4 text-lg">
                    <li>
                        <a class="transition hover:opacity-80" href="{{ url('/') }}">Pocetna</a>
                    </li>
                    <li>
                        <a class="transition hover:opacity-80" href="{{ url('/shop') }}">Shop</a>
                    </li>
                    <li>
                        <a class="transition hover:opacity-80" href="{{ url('/contact') }}">Kontakt</a>
                    </li>
                    <li>
                        <a class="flex items-center gap-2 transition hover:opacity-80" href="{{ url('/cart') }}">
                            <span class="flex items-center justify-center" aria-hidden="true">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path d="M3 3h2l2.2 10.1A2 2 0 0 0 9.15 15H18a2 2 0 0 0 1.94-1.5L22 7H7"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1.5" fill="currentColor" stroke="none" />
                                    <circle cx="18" cy="20" r="1.5" fill="currentColor" stroke="none" />
                                </svg>
                            </span>
                            <span>Korpa</span>
                        </a>
                    </li>

                    @guest
                        <li>
                            <a class="flex items-center gap-2 transition hover:opacity-80" href="{{ url('/prijava') }}">
                                <span class="flex items-center justify-center" aria-hidden="true">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 8a7 7 0 0 1 14 0"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span>Prijava</span>
                            </a>
                        </li>
                    @endguest

                </ul>
            </nav>
        </div>

        <div class="text-secondary-color flex flex-col gap-4 text-lg">
            <h4 class="text-2xl font-semibold">Kontakt</h4>
            <address class="not-italic">
                <p>Zdravka Celara 1, Novi grad, Beograd</p>
            </address>
            <a class="transition hover:opacity-80" href="tel:+111222333">+111 222-333</a>
            <a class="break-all transition hover:opacity-80" href="mailto:exmoor23@gmail.com">exmoor23@gmail.com</a>
            {{-- <p>RSS &amp; SITEMAP</p> --}}
            <a target="_blank"
                href="https://docs.google.com/document/d/14VFhHnE1wXvzJvdk7aRGN52EpVKT6kezRIlkECFUr6k/edit?usp=sharing">Dokumentacija</a>
        </div>

        <div class="text-secondary-color">
            <h4 class="mb-4 text-2xl font-semibold">Drustvene mreze</h4>
            <div class="flex gap-6 text-secondary-color">
                <a class="transition hover:opacity-80" href="#" aria-label="Instagram">
                    <svg class="h-9 w-9" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5a4.25 4.25 0 0 0 4.25 4.25h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5Zm5.25-2.13a1.13 1.13 0 1 1 0 2.26 1.13 1.13 0 0 1 0-2.26Z" />
                    </svg>
                </a>
                <a class="transition hover:opacity-80" href="mailto:exmoor23@gmail.com" aria-label="Email">
                    <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        aria-hidden="true">
                        <path d="M4 6h16v12H4z" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="m4 7 8 6 8-6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <a class="transition hover:opacity-80" href="#" aria-label="YouTube">
                    <svg class="h-9 w-9" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M21.58 7.19a2.98 2.98 0 0 0-2.1-2.1C17.64 4.5 12 4.5 12 4.5s-5.64 0-7.48.59a2.98 2.98 0 0 0-2.1 2.1C1.83 9.03 1.83 12 1.83 12s0 2.97.59 4.81a2.98 2.98 0 0 0 2.1 2.1c1.84.59 7.48.59 7.48.59s5.64 0 7.48-.59a2.98 2.98 0 0 0 2.1-2.1c.59-1.84.59-4.81.59-4.81s0-2.97-.59-4.81ZM10 15.5v-7l6 3.5-6 3.5Z" />
                    </svg>
                </a>
                <a class="transition hover:opacity-80" href="#" aria-label="GitHub">
                    <svg class="h-9 w-9" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.21.68-.48v-1.7c-2.78.6-3.37-1.18-3.37-1.18-.45-1.16-1.11-1.47-1.11-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.88 1.52 2.32 1.08 2.89.83.09-.64.35-1.08.63-1.33-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.98 1.03-2.68-.1-.26-.45-1.29.1-2.69 0 0 .84-.27 2.75 1.02A9.5 9.5 0 0 1 12 6.84c.85 0 1.71.11 2.51.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.4.2 2.43.1 2.69.64.7 1.03 1.59 1.03 2.68 0 3.85-2.34 4.69-4.57 4.94.36.31.68.92.68 1.86v2.76c0 .27.18.58.69.48A10 10 0 0 0 12 2Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="px-6 pb-6 sm:px-10 lg:px-12">
        <p class="text-secondary-color text-center text-sm sm:text-base">
            Privacy | Terms &amp; Conditions | Contact Copyright &copy; 2025 All Rights Reserved.
        </p>
    </div>
</footer>