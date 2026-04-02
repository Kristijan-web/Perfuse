@extends('layouts.user')


@section('title', 'Shop')
@section('description', 'home page of the website')

@section('content')
    @php

    @endphp

    <section class="gradient_image_shop relative mb-18 h-thumbnail w-full bg-cover bg-no-repeat bg-left sm:bg-center ">
        <div class="text-secondary-color absolute top-1/2 mx-auto max-w-7xl -translate-y-1/2 px-7 sm:left-[10%]">
            <div class="flex w-full flex-col gap-4 sm:w-[70%] sm:gap-3">
                <h1 class="text-start text-4xl">
                    Izaberite jednog od najboljih prodavaca parfema na svetu.
                </h1>
                <p class="text-2xl">
                    Visoko kvalitetni parfemi od poznatih brendova
                </p>
                <p class="text-xl">Mirisi koji govore vise od hiljadu reci</p>
            </div>
        </div>
    </section>

    <section class="mb-24">
        <div class="mx-auto grid max-w-[1600px] grid-cols-12 grid-rows-[42px_auto_auto] items-start gap-4 px-4">
            <form method="GET" action="{{ route('shopPage') }}"
                class="bg-main-color-shade text-secondary-color row-start-2 row-end-3 col-start-1 col-end-7  rounded-sm py-4 lg:row-start-1 lg:row-end-3 lg:col-start-1 lg:col-end-4 lg:h-full lg:bg-white lg:p-5 lg:py-4 lg:text-main-color-shade lg:shadow-my-shadow">
                <div class="flex items-center justify-between px-4 lg:hidden">
                    <span>Filteri</span>
                    <span class="flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>

                <div class="hidden flex-col gap-9 lg:flex">
                    <h3 class="mb-6 text-center text-xl">Filtriraj parfeme</h3>

                    <div>
                        <p class="mb-4 text-xl">Proizvođač</p>
                        <div class="flex flex-col gap-3">
                            @foreach ($brands as $brandRecord)
                                <label class="flex items-center justify-between gap-3">
                                    <span class="flex items-center gap-3">
                                        <input type="checkbox" name="brand[]" value="{{ $brandRecord->title }}" {{ in_array($brandRecord->title, $request->query('brand', [])) ? 'checked' : '' }}
                                            class="h-4 w-4 rounded border-gray-300 text-black">
                                        <span>{{ $brandRecord->title }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mx-auto w-full max-w-md rounded-lg bg-white px-2">
                        <div class="mb-8 text-center">
                            <h2 class="text-xl font-bold text-gray-800">Izaberite cenu</h2>
                            <p class="mt-2 text-lg text-gray-600">
                                Izabrani raspon:
                                <span class="font-semibold text-main-color-shade">20 - 80</span>
                            </p>
                        </div>

                        <div class="relative pt-6 pb-6">
                            <div class="relative h-2 w-full rounded-full bg-gray-200">
                                <div class="bg-main-color-shade absolute h-full rounded-full"
                                    style="left: 20%; right: 20%;"></div>
                            </div>

                            <div class="pointer-events-none absolute left-0 top-0 mt-0 w-full">
                                <input type="range" min="0" max="100" value="20"
                                    class="pointer-events-none absolute left-0 -mt-6 w-full appearance-none bg-transparent">
                                <input type="range" min="0" max="100" value="80"
                                    class="pointer-events-none absolute left-0 -mt-6 w-full appearance-none bg-transparent">
                            </div>
                        </div>

                        <div class="mt-2 flex justify-between">
                            <div class="text-sm font-medium text-gray-500">0</div>
                            <div class="text-sm font-medium text-gray-500">100</div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-4 text-xl">Pol</p>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3">
                                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-black" {{-- // ako je
                                    izabran checkbox treba da ostane nakon request-a --}} {{-- Ako je ova vrednost ovog
                                    inputa u array $request->query('gender', []) onda staviti checked --}}
                                {{ in_array('muski', $request->query('gender', [])) ? 'checked' : ''}}
                                name="gender[muski]" value="muski">
                                <span>Muški</span>
                            </label>
                            <label class="flex items-center gap-3">
                                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-black" name="gender[]"
                                {{ in_array('zenski', $request->query('gender', [])) ? 'checked' : "" }}
                                    value="zenski">
                                <span>Ženski</span>
                            </label>

                        </div>
                    </div>

                    <div>
                        <p class="mb-4 text-xl">Kategorija parfema</p>
                        <div class="flex flex-col gap-3">
                            @foreach ($waterTypes as $waterType)
                                <label class="flex items-center justify-between gap-3">
                                    <span class="flex items-center gap-3">
                                        <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-black" name="waterType[]"  value=" {{$waterType->type  }}" {{ in_array($waterType->type, $request->query('waterType', [])) ? 'checked' : '' }}>
                                        <span>{{ $waterType->type }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="mb-4 text-xl">Na popustu</p>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-black " name='onSale[]' value="1"  {{ in_array('1', $request->query('onSale', [])) ? 'checked' : '' }}>
                           
                            <span>Da</span>
                        </label>
                    </div>

                    <div class='w-full flex items-center justify-center'>
                        <button class="btn w-30 p-2 ">Filtriraj</button>

                    </div>

                </div>
            </form>

            <div
                class="relative col-span-full row-start-1 row-end-2 h-11 self-start overflow-visible lg:col-start-4 lg:col-end-10 lg:w-full lg:overflow-hidden xl:w-[108%] 2xl:col-end-9">
                <input type="text" placeholder="Pretrazite..."
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" />
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xl text-gray-500">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-3.5-3.5" stroke-linecap="round" />
                    </svg>
                </span>
            </div>

            <div
                class="bg-main-color-shade text-secondary-color col-start-7 col-end-13  rounded-sm py-4 lg:col-start-10 lg:col-end-13 lg:bg-white lg:py-0 lg:text-main-color-shade 2xl:col-start-9">
                <div class="flex items-center justify-between px-4 lg:hidden">
                    <span>Sort</span>
                    <span class="flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>

                <div class="hidden h-11 w-full items-center justify-end gap-3 lg:flex">
                    <p class="text-xl">Sortiraj cenu:</p>
                    <div class="hidden items-center gap-3 lg:flex 2xl:hidden">
                        <select class="rounded-sm border border-gray-300 px-3 py-2">
                            <option>Prvo najmanja</option>
                            <option>Prvo najveca</option>
                        </select>
                    </div>
                    <div class="hidden items-center gap-3 2xl:flex">
                        <button class="btn px-9 py-2">Prvo najmanja</button>
                        <button class="btn px-9 py-2">Prvo najveca</button>
                    </div>
                </div>
            </div>

            <div
                class="col-span-full mt-8 grid grid-cols-1 justify-self-center gap-5 sm:grid-cols-2 md:grid-cols-3 lg:col-start-4 lg:col-end-13 lg:mt-0 lg:grid-cols-3 2xl:grid-cols-4">
                @foreach ($products as $product)

                    <x-user.shop-layout.product-item :product="$product" />


                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="mx-auto flex flex-col items-center justify-center bg-[#f3f3f3] px-6 py-4 lg:h-80">
            <h1 class="mb-10 text-center text-3xl">E-kupovina beneficije</h1>

            <div
                class="grid w-full grid-cols-1 items-center justify-items-center gap-15 gap-y-10 sm:grid-cols-2 sm:gap-x-2 lg:grid-cols-4">
                <div class="flex flex-col items-center justify-center gap-2">
                    <span class="text-4xl">
                        <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M1 3h3l2.4 10.2h11.9L21 6H6.2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="9" cy="19" r="1.5"></circle>
                            <circle cx="18" cy="19" r="1.5"></circle>
                        </svg>
                    </span>
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl">Očekivana dostava</p>
                        <p class="text-main-color-shade/70">Dostava u roku od 4 do 7 dana</p>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-2">
                    <span class="text-4xl">
                        <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 2v20" stroke-linecap="round" />
                            <path
                                d="M17 6.5c0-1.9-2.2-3.5-5-3.5S7 4.6 7 6.5 9.2 10 12 10s5 1.6 5 3.5S14.8 17 12 17s-5-1.6-5-3.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl">Način plaćanja</p>
                        <p class="text-main-color-shade/70">Pouzecem kuriske sluzbe</p>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-2">
                    <span class="text-4xl">
                        <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 3v18" stroke-linecap="round" />
                            <path d="M5 9h14M5 15h14" stroke-linecap="round" />
                            <path d="M7 6h4l-1 3 1 3H7l1-3-1-3Zm6 6h4l-1 3 1 3h-4l1-3-1-3Z" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl">Osvojite kupone</p>
                        <p class="text-main-color-shade/70">Osvojite kupon pri registraciji naloga</p>
                    </div>
                </div>

                <div class="mb-10 flex flex-col items-center justify-center gap-2 lg:mb-0">
                    <span class="text-3xl lg:text-4xl">
                        <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 20c1.6-4 5-6 8-6s6.4 2 8 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl">Dobijajte novosti</p>
                        <p class="text-main-color-shade/70">registrujte nalog i budite u toku</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection