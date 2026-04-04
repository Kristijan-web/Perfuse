@extends('layouts.user')

@section('title', 'Product Details')



@section('content')

    {{-- // Koje podatke sadrzi 1 procuct?
    // - title
    // - price
    // - gender
    // - brand_id
    // - water_type_id
    // - discount_id
    // - ml_ids [array]
    // - images [array]

    // Odakle se prosledjuju podaci za ovaj view
    // - iz PageControlera

    // Da li su podaci eager loadovani? --}}

    @php
        // dohvatanje main slike
        // $main_image;
        // foreach ($product->images as $row) {
        //     // imam 1 red
        //     if ($row->is_main_image) {
        //         $main_image = $row->path;
        //     }
        // }
        // dd($main_image);
    @endphp

    <section class="mx-auto max-w-7xl px-6 py-12 lg:px-12 lg:py-16">
        <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
            <div class="space-y-5">
                <div class="overflow-hidden rounded-xl bg-white shadow-my-shadow">
                    <div class="bg-linear-to-br from-stone-100 via-white to-stone-200 p-8 sm:p-12">
                        {{-- // ispod je main Image --}}
                        {{-- // Kako ce se uzeti main image?
                        -- // Procice se kroz sve slike i uzeti main


                        --}}
                        <img src="{{ 5 }}" alt="{{ 5 }} " class="mx-auto aspect-square w-full max-w-md object-contain">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">

                    {{-- // ispisati sve slike za proizvod --}}

                    @foreach($product->images as $row)


                        <div
                            class="overflow-hidden rounded-lg border <?php    echo $index === 0 ? 'border-black bg-stone-100' : 'border-black/10 bg-white'; ?> p-4">
                            <img src="{{ $row->path }}" alt="product image" class=" aspect-square w-full object-contain">
                        </div>

                    @endforeach


                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-xl bg-white p-7 shadow-my-shadow sm:p-9">
                    <div class="mb-5 flex flex-wrap items-center gap-3">
                        <span class="rounded-md bg-black px-4 py-2 text-xs uppercase tracking-[0.25em] text-white">
                            {{ $product->gender }}
                        </span>
                        <span
                            class="rounded-md border border-black/10 px-4 py-2 text-xs uppercase tracking-[0.25em] text-black/70">
                            {{ $product->waterType->type }}
                        </span>
                        <span
                            class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs uppercase tracking-[0.2em] text-emerald-700">
                            -
                            {{ $product->discount->discount }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-end gap-4 border-b border-black/10 pb-6">
                        <div class="flex items-center gap-3">
                            <span class="text-4xl font-semibold">
                                {{-- // ovde se prikazuje cena na popustu --}}
                                {{-- {{ $discountPrice }} --}}
                                BUDUCA CENA NA POPUSTU
                            </span>
                            <s class="text-lg text-black/45">
                                {{-- // ovde se prikazuje precrtana stara cena --}}
                                {{ $product->price }}
                            </s>
                        </div>
                        <span class="text-sm text-black/55">PDV ukljucen u cenu</span>
                    </div>

                    <div class="grid gap-4 py-6 sm:grid-cols-2">
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Militraza</p>
                            <p class="mt-2 text-xl">
                                OVDE CE MILITRAZA
                            </p>
                        </div>
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Trajnost</p>
                            <p class="mt-2 text-xl">
                                LONGEVITY
                            </p>
                        </div>
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Koncentracija</p>
                            <p class="mt-2 text-xl">
                                CONCENTRATION
                            </p>
                        </div>
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Poreklo</p>
                            <p class="mt-2 text-xl">
                                POREKLO
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex flex-col gap-4 border-t border-black/10 pt-6 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-black/50">Ocena kupaca</p>
                            <p class="text-lg">
                                5 / 5 <span class="text-black/45"> 10 RECENZIJA
                                </span>
                            </p>
                        </div>
                        <div class="flex gap-3">
                            <button class="btn">Dodaj u korpu</button>
                            <button
                                class="rounded-sm border border-main-color-shade px-6 py-3 transition hover:bg-black hover:text-white">
                                Sacuvaj
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">

                    <div class="rounded-lg border border-black/10 bg-white p-5 shadow-sm">
                        <p class="text-sm leading-7 text-black/75">
                            HIGHLIGHT
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection