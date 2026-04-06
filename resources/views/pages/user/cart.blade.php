@extends('layouts.user')

@section('title', 'Cart')

@section('content')
    @php
        $subtotal = $products->sum(function ($cartItem) {
            $product = $cartItem->product;

            if (!$product) {
                return 0;
            }

            $discountPercent = $product->discount?->discount;
            $finalPrice = $discountPercent
                ? $product->price - round(($product->price * $discountPercent) / 100)
                : $product->price;

            return $finalPrice * $cartItem->quantity;
        });
    @endphp

    <section class="mx-auto max-w-7xl px-6 py-12 lg:px-12 lg:py-16">
        <div class="mb-10 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-black/45">Perfuse korpa</p>
                <h1 class="text-3xl font-semibold tracking-tight text-black sm:text-4xl">Vasi proizvodi</h1>
            </div>
            <p class="text-sm text-black/55">{{ $products->count() }} artikala u korpi</p>
        </div>

        @if ($products->isEmpty())
            <div class="rounded-2xl border border-dashed border-black/15 bg-white px-6 py-16 text-center shadow-my-shadow">
                <p class="text-sm uppercase tracking-[0.24em] text-black/45">Korpa je trenutno prazna</p>
                <h2 class="mt-3 text-2xl font-semibold text-black">Dodajte parfeme koje zelite da sacuvate za kupovinu.</h2>
                <a href="{{ route('shopPage') }}" class="btn mt-8 inline-flex px-8 py-3">Nazad u shop</a>
            </div>
        @else
            <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                <div class="space-y-5">
                    @foreach ($products as $cartItem)
                        @php
                            $product = $cartItem->product;
                            $mainImage = $product?->images->firstWhere('is_main_image', true)?->path
                                ?? $product?->images->first()?->path;
                            $discountPercent = $product->discount?->discount;
                            $finalPrice = $discountPercent
                                ? $product->price - round(($product->price * $discountPercent) / 100)
                                : $product->price;
                        @endphp

                        @if ($product)
                            <article class="grid gap-5 rounded-2xl bg-white p-5 shadow-my-shadow sm:grid-cols-[140px_1fr] sm:p-6">
                                <a href="{{ route('productDetails', $product->id) }}"
                                    class="flex items-center justify-center rounded-xl bg-stone-100 p-4">
                                    @if ($mainImage)
                                        {{-- http://127.0.0.1:8000/Images/ShopPage/Thumbnail/thumbnail.jpg --}}
                                        {{-- src="{{ $mainImage }}" --}}
                                        <img src="http://127.0.0.1:8000/Images/ShopPage/Thumbnail/thumbnail.jpg"
                                            alt="{{ $product->brand?->title }} {{ $product->title }}"
                                            class="aspect-square w-full max-w-[120px] object-contain">
                                    @else
                                        <div
                                            class="flex aspect-square w-full max-w-[120px] items-center justify-center rounded-lg border border-dashed border-black/15 bg-white text-xs uppercase tracking-[0.2em] text-black/35">
                                            Nema slike
                                        </div>
                                    @endif
                                </a>

                                <div class="flex flex-col gap-4">
                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <p class="text-xs uppercase tracking-[0.24em] text-black/45">
                                                {{ $product->brand?->title ?? 'Brend' }}
                                            </p>
                                            <a href="{{ route('productDetails', $product->id) }}"
                                                class="mt-1 block text-2xl font-semibold tracking-tight text-black">
                                                {{ $product->title }}
                                            </a>
                                        </div>

                                        <div class="text-left sm:text-right">
                                            <p class="text-2xl font-semibold text-black">
                                                {{ number_format($finalPrice, 0, ',', '.') }} RSD
                                            </p>
                                            @if ($discountPercent)
                                                <s class="text-sm text-black/45">
                                                    {{ number_format($product->price, 0, ',', '.') }} RSD
                                                </s>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-3 text-sm">
                                        <span class="rounded-md bg-black px-3 py-2 uppercase tracking-[0.18em] text-white">
                                            {{ $product->gender }}
                                        </span>
                                        <span
                                            class="rounded-md border border-black/10 px-3 py-2 uppercase tracking-[0.18em] text-black/70">
                                            {{ $product->waterType?->type ?? 'Bez tipa' }}
                                        </span>
                                        @if ($product->mls->isNotEmpty())
                                            <span class="rounded-md border border-black/10 px-3 py-2 text-black/70">
                                                {{ $product->mls->sortBy('size_ml')->pluck('size_ml')->implode(' / ') }} ml
                                            </span>
                                        @endif
                                        <span class="rounded-md border border-black/10 px-3 py-2 text-black/70">
                                            Kolicina: {{ $cartItem->quantity }}
                                        </span>
                                        @if ($discountPercent)
                                            <span class="rounded-md bg-emerald-50 px-3 py-2 text-emerald-700">
                                                -{{ $discountPercent }}%
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        {{-- @php
                                        dd($cartItem->id);
                                        @endphp --}}
                                        <form method="POST" action="{{ route('deleteCartItemAPI', $cartItem->cart_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="product_id" value="{{ $cartItem->product_id }}">
                                            <button type="submit"
                                                class="rounded-sm border cursor-pointer border-red-300 px-4 py-2 text-sm text-red-700 transition hover:bg-red-50">
                                                Obrisi iz korpe
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>

                <aside class="h-fit rounded-2xl bg-white p-6 shadow-my-shadow sm:p-7">
                    <p class="text-sm uppercase tracking-[0.24em] text-black/45">Pregled porudzbine</p>
                    <div class="mt-6 space-y-4 border-y border-black/10 py-6">
                        <div class="flex items-center justify-between text-sm text-black/60">
                            <span>Artikli</span>
                            <span>{{ $products->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-black/60">
                            <span>Dostava</span>
                            <span>Besplatna</span>
                        </div>
                        <div class="flex items-center justify-between text-lg font-semibold text-black">
                            <span>Ukupno</span>
                            <span>{{ number_format($subtotal, 0, ',', '.') }} RSD</span>
                        </div>
                    </div>

                    <a href="{{ route('orderPage') }}" class="btn mt-6 flex w-full items-center justify-center px-6 py-3">
                        Porucite
                    </a>
                </aside>
            </div>
        @endif
    </section>

@endsection