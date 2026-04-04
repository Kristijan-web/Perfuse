@extends('layouts.user')

@section('title', 'home')


@section('content')
    <section class="relative isolate overflow-hidden">
        <div class="absolute inset-0 -z-20 bg-black"></div>
        <div class="absolute inset-0 -z-10 bg-cover bg-center opacity-55"
            style="background-image: url('{{ asset('images/ShopPage/Thumbnail/thumbnail.jpg') }}');"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-black via-black/70 to-black/35"></div>

        <div class="mx-auto flex min-h-[calc(100vh-80px)] max-w-7xl items-center px-6 py-16 lg:px-12">
            <div class="max-w-3xl text-white">
                <p class="mb-4 text-sm uppercase tracking-[0.24em] text-white/70">
                    Perfuse-Inspired to last
                </p>
                <h1 class="max-w-2xl text-3xl font-semibold tracking-tight sm:text-4xl lg:text-5xl">
                    Mirisi koji ostavljaju utisak pre nego sto izgovoris rec.
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-8 text-white/75">
                    Premium selekcija parfema za svakodnevne rituale, posebne prilike i prostor u kojem zelis da se
                    zadrzis malo duze.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('shopPage') }}" class="btn">
                        Pogledaj proizvode
                    </a>
                    <a href="#collections"
                        class="inline-flex items-center rounded-sm border border-white/30 px-6 py-3 text-white transition hover:bg-white hover:text-black">
                        Istrazi kolekcije
                    </a>
                </div>

                <div class="mt-12 grid max-w-2xl gap-4 sm:grid-cols-3">
                    <div class="rounded-xl border border-white/10 bg-white/8 p-5 backdrop-blur-sm">
                        <p class="text-3xl font-semibold">120+</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.24em] text-white/65">Premium mirisa</p>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/8 p-5 backdrop-blur-sm">
                        <p class="text-3xl font-semibold">24h</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.24em] text-white/65">Brza obrada porudzbine</p>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/8 p-5 backdrop-blur-sm">
                        <p class="text-3xl font-semibold">4.9/5</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.24em] text-white/65">Ocena kupaca</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-20 text-center lg:px-12">
        <div class="mx-auto max-w-2xl">
            <p class="text-sm uppercase tracking-[0.24em] text-black/45">Zasto Perfuse</p>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-black sm:text-4xl">
                Budite svoja inspiracija
            </h2>
        </div>

        <div class="mt-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <article class="rounded-2xl bg-white p-8 shadow-my-shadow">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-stone-100 text-black">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="m12 3 7 4v5c0 4.4-3 7.8-7 9-4-1.2-7-4.6-7-9V7l7-4Z" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="m9.5 12 1.7 1.7 3.8-4.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-5 text-xl font-semibold">Kvalitet</h3>
                <p class="mt-3 text-lg leading-8 text-black/60">
                    Biramo proverene formule i mirisne profile koji ostaju postojani i elegantni tokom celog dana.
                </p>
            </article>

            <article class="rounded-2xl bg-white p-8 shadow-my-shadow">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-stone-100 text-black">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="12" cy="12" r="8.5" />
                        <path d="M12 7.5v5l3.5 2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-5 text-xl font-semibold">Trajnost</h3>
                <p class="mt-3 text-lg leading-8 text-black/60">
                    Note koje se razvijaju postepeno i prate te od jutarnjih obaveza do vecernjih izlazaka.
                </p>
            </article>

            <article class="rounded-2xl bg-white p-8 shadow-my-shadow">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-stone-100 text-black">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M12 3v18" stroke-linecap="round" />
                        <path
                            d="M16.5 7.5c0-1.8-2-3.2-4.5-3.2S7.5 5.7 7.5 7.5 9.5 10.7 12 10.7s4.5 1.4 4.5 3.3-2 3.2-4.5 3.2-4.5-1.4-4.5-3.2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-5 text-xl font-semibold">Cena</h3>
                <p class="mt-3 text-lg leading-8 text-black/60">
                    Balans premium utiska i pristupacnosti, bez kompromisa kada je u pitanju zavrsni kvalitet.
                </p>
            </article>

            <article class="rounded-2xl bg-white p-8 shadow-my-shadow">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-stone-100 text-black">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path
                            d="M12 20c4.4-2.2 7-6 7-10.3-1.7 0-3.2.5-4.6 1.5C13.8 8.6 13 6.5 12 4c-1 2.5-1.8 4.6-2.4 7.2C8.2 10.2 6.7 9.7 5 9.7 5 14 7.6 17.8 12 20Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="mt-5 text-xl font-semibold">Odgovorno</h3>
                <p class="mt-3 text-lg leading-8 text-black/60">
                    Fokus na uredno pakovanje, pazljivu isporuku i dugorocan odnos prema proizvodu i kupcu.
                </p>
            </article>
        </div>
    </section>

    <section class="bg-secondary-new">
        <div class="mx-auto grid max-w-6xl gap-12 px-6 py-20 lg:grid-cols-[0.95fr_1.05fr] lg:items-center lg:px-12">
            <div class="order-2 lg:order-1">
                <p class="text-sm uppercase tracking-[0.24em] text-black/45">O nama</p>
                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-black sm:text-4xl">
                    Perfuse preuzima Exmoor energiju i pretvara je u cist, moderan shop dozivljaj.
                </h2>
                <p class="mt-6 text-lg leading-8 text-black/65">
                    Ideja je jednostavna: luksuzan osecaj bez nepotrebne komplikacije. Jasna selekcija, uredna
                    prezentacija i mirisi koji pokrivaju svakodnevne potpise, poklone i kucnu atmosferu.
                </p>
                <p class="mt-4 text-lg leading-8 text-black/65">
                    Svaki detalj je slozen da kupovina djeluje smireno, elegantno i sigurno, od prvog utiska do
                    posljednjeg klika na proizvod koji zelis da zadrzis ili poklonis.
                </p>
                <div class="mt-8">
                    <a href="{{ route('shopPage') }}" class="btn">Idi u shop</a>
                </div>
            </div>

            <div class="order-1 lg:order-2">
                <div class="relative mx-auto max-w-xl overflow-hidden rounded-[2rem] bg-white p-4 shadow-my-shadow">
                    <div class="aspect-[4/5] overflow-hidden rounded-[1.5rem]">
                        <img src="{{ asset('images/ShopPage/Products/shop-item-1.jpg') }}" alt="Perfume bottle"
                            class="h-full w-full object-cover">
                    </div>
                    <div
                        class="absolute bottom-8 left-8 right-8 rounded-2xl border border-white/50 bg-black/65 p-5 text-white backdrop-blur-sm">
                        <p class="text-xs uppercase tracking-[0.24em] text-white/70">Signature Selection</p>
                        <p class="mt-2 text-xl font-semibold sm:text-2xl">Od statement mirisa do diskretnih dnevnih nota.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="collections" class="px-0 py-20">
        <div class="mx-auto mb-10 max-w-6xl px-6 text-center lg:px-12">
            <p class="text-sm uppercase tracking-[0.24em] text-black/45">Kolekcije</p>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-black sm:text-4xl">
                Tri pravca na tebi je da izaberes
            </h2>
        </div>

        <div class="grid min-h-[860px] grid-cols-1 gap-px bg-black/10 sm:grid-cols-2 sm:grid-rows-2">
            <a href="{{ route('shopPage', ['gender' => 'male']) }}"
                class="group relative min-h-[320px] overflow-hidden sm:row-span-2">
                <div class="absolute inset-0 bg-cover bg-center transition duration-500 group-hover:scale-105"
                    style="background-image: linear-gradient(rgba(0, 0, 0, 0.36), rgba(0, 0, 0, 0.58)), url('{{ asset('images/ShopPage/Thumbnail/thumbnail.jpg') }}');">
                </div>
                <div class="relative flex h-full items-end justify-center p-10 text-center text-white">
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-white/70">Collection 01</p>
                        <span class="mt-3 block text-3xl font-semibold sm:text-4xl">Muski parfemi</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('shopPage', ['gender' => 'female']) }}" class="group relative min-h-[260px] overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center transition duration-500 group-hover:scale-105"
                    style="background-image: linear-gradient(rgba(0, 0, 0, 0.34), rgba(0, 0, 0, 0.55)), url('{{ asset('images/ShopPage/Products/shop-item-1.jpg') }}');">
                </div>
                <div class="relative flex h-full items-end justify-center p-10 text-center text-white">
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-white/70">Collection 02</p>
                        <span class="mt-3 block text-3xl font-semibold sm:text-4xl">Zenski parfemi</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('shopPage') }}" class="group relative min-h-[260px] overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center transition duration-500 group-hover:scale-105"
                    style="background-image: linear-gradient(rgba(0, 0, 0, 0.38), rgba(0, 0, 0, 0.62)), url('{{ asset('images/ShopPage/Thumbnail/thumbnail.jpg') }}');">
                </div>
                <div class="relative flex h-full items-end justify-center p-10 text-center text-white">
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-white/70">Collection 03</p>
                        <span class="mt-3 block text-3xl font-semibold sm:text-4xl">Kucni parfemi</span>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <section class="pb-10 pt-6">
        <div class="mb-20 grid grid-cols-1 xl:grid-cols-12">
            <div class="flex h-24 items-center justify-center bg-stone-200 px-4 xl:col-span-3 xl:justify-start xl:px-12">
                <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl">Recenzije</h2>
            </div>
            <div class="hidden h-24 bg-stone-300 xl:col-span-4 xl:block"></div>
            <div class="hidden h-24 bg-black xl:col-span-5 xl:block"></div>
        </div>

        <div class="mx-auto grid max-w-7xl gap-20 px-6 md:grid-cols-3 lg:px-12">
            <article class="relative rounded-sm bg-stone-200 p-9 pt-16 shadow-my-shadow">
                <div
                    class="absolute -top-10 left-1/2 flex h-20 w-20 -translate-x-1/2 items-center justify-center rounded-full border border-black/10 bg-white text-2xl font-semibold">
                    M
                </div>
                <p class="text-center text-lg leading-8 text-black/70">
                    Sjajan balans jacine i elegancije. Miris deluje premium i ostaje prisutan satima bez da bude
                    napadan.
                </p>
                <p class="mt-6 text-center text-xl font-semibold">Milos</p>
                <p class="mt-3 text-center text-sm uppercase tracking-[0.24em] text-amber-500">5/5 rating</p>
            </article>

            <article class="relative rounded-sm bg-stone-300 p-9 pt-16 shadow-my-shadow">
                <div
                    class="absolute -top-10 left-1/2 flex h-20 w-20 -translate-x-1/2 items-center justify-center rounded-full border border-black/10 bg-white text-2xl font-semibold">
                    N
                </div>
                <p class="text-center text-lg leading-8 text-black/70">
                    Narucivanje je bilo jednostavno, a prezentacija proizvoda odmah ostavlja utisak ozbiljnog brenda.
                </p>
                <p class="mt-6 text-center text-xl font-semibold">Nikola</p>
                <p class="mt-3 text-center text-sm uppercase tracking-[0.24em] text-amber-500">5/5 rating</p>
            </article>

            <article class="relative rounded-sm bg-black p-9 pt-16 text-white shadow-my-shadow">
                <div
                    class="absolute -top-10 left-1/2 flex h-20 w-20 -translate-x-1/2 items-center justify-center rounded-full border  border-black/10 bg-white text-2xl font-semibold text-black">
                    B
                </div>
                <p class="text-center text-lg leading-8 text-white/75">
                    Homepage izgleda cisto, moderno i daje isti premium osecaj koji je Exmoor imao, ali u novom
                    okruzenju.
                </p>
                <p class="mt-6 text-center text-xl font-semibold">Bojan</p>
                <p class="mt-3 text-center text-sm uppercase tracking-[0.24em] text-amber-400">5/5 rating</p>
            </article>
        </div>
    </section>

@endsection