@extends('layouts.user')

@section('title', 'Product Details')



@section('content')

    @php
        $mainImage = $product->images->firstWhere('is_main_image', true)?->path
            ?? $product->images->first()?->path;

        $discountPercent = $product->discount?->discount;
        $discountedPrice = $discountPercent
            ? $product->price - round(($product->price * $discountPercent) / 100)
            : null;

    @endphp

    <section class="mx-auto max-w-7xl px-6 py-12 lg:px-12 lg:py-16">
        <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
            <div class="space-y-5">
                <div class="overflow-hidden rounded-xl bg-white shadow-my-shadow">
                    <div class="bg-linear-to-br from-stone-100 via-white to-stone-200 p-8 sm:p-12">
                        @if ($mainImage)
                            <img src="{{ $mainImage }}" alt="{{ $product->brand->title }} {{ $product->title }}"
                                class="mx-auto aspect-square w-full max-w-md object-contain">
                        @else
                            <div
                                class="mx-auto flex aspect-square w-full max-w-md items-center justify-center rounded-lg border border-dashed border-black/15 bg-white/70 text-sm uppercase tracking-[0.2em] text-black/35">
                                Nema slike
                            </div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                    @forelse($product->images as $row)
                        <div
                            class="overflow-hidden rounded-lg border {{ $row->is_main_image ? 'border-black bg-stone-100' : 'border-black/10 bg-white' }} p-4">
                            <img src="{{ $row->path }}" alt="{{ $product->brand->title }} {{ $product->title }}"
                                class="aspect-square w-full object-contain">
                        </div>
                    @empty
                        <div
                            class="col-span-full rounded-lg border border-dashed border-black/15 bg-white p-6 text-center text-sm text-black/45">
                            Nema dodatnih slika za ovaj proizvod.
                        </div>
                    @endforelse
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
                            {{ $product->waterType?->type ?? 'Bez tipa' }}
                        </span>
                        @if ($discountPercent)
                            <span
                                class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs uppercase tracking-[0.2em] text-emerald-700">
                                -{{ $discountPercent }}%
                            </span>
                        @endif
                    </div>

                    <div class="space-y-2 border-b border-black/10 pb-6">
                        <p class="text-sm uppercase tracking-[0.24em] text-black/45">
                            {{ $product->brand?->title ?? 'Brend' }}
                        </p>
                        <h1 class="text-3xl font-semibold tracking-tight text-black sm:text-4xl">
                            {{ $product->title }}
                        </h1>
                    </div>

                    <div class="flex flex-wrap items-end gap-4 border-b border-black/10 pb-6">
                        <div class="flex items-center gap-3">
                            <span class="text-4xl font-semibold">
                                {{ number_format($discountedPrice ?? $product->price, 0, ',', '.') }} RSD
                            </span>
                            @if ($discountedPrice)
                                <s class="text-lg text-black/45">
                                    {{ number_format($product->price, 0, ',', '.') }} RSD
                                </s>
                            @endif
                        </div>
                        <span class="text-sm text-black/55">PDV ukljucen u cenu</span>
                    </div>

                    <div class="grid gap-4 py-6 sm:grid-cols-2">
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Militraza</p>
                            @if ($product->mls->isNotEmpty())
                                <select name="ml_id"
                                    class="mt-2 w-full rounded-md border border-black/10 bg-white px-3 py-2 text-sm text-black outline-none transition focus:border-black/30">
                                    @foreach($product->mls->sortBy('size_ml') as $ml)
                                        <option value="{{ $ml->id }}">{{ $ml->size_ml }} ml</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="mt-2 text-sm text-black/45">Nije navedeno</p>
                            @endif
                        </div>
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Pol</p>
                            <p class="mt-2 text-xl">
                                {{ $product->gender }}
                            </p>
                        </div>
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Vrsta vode</p>
                            <p class="mt-2 text-xl">
                                {{ $product->waterType?->type ?? 'Nije navedeno' }}
                            </p>
                        </div>
                        <div class="rounded-lg bg-stone-100 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">Brend</p>
                            <p class="mt-2 text-xl">
                                {{ $product->brand?->title ?? 'Nije navedeno' }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex flex-col gap-4 border-t border-black/10 pt-6 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex gap-3">
                            <button class="btn">Dodaj u korpu</button>
                            <button
                                class="rounded-sm border border-main-color-shade px-6 py-3 transition hover:bg-black hover:text-white">
                                Sacuvaj
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
