@extends('layouts.user')


@section('title', 'Order')


@section('content')
    @php
        $orderItems = $products->filter(fn($cartItem) => $cartItem->product);

        $subtotal = $orderItems->sum(function ($cartItem) {
            $product = $cartItem->product;
            $discountPercent = $product->discount?->discount;
            $finalPrice = $discountPercent
                ? $product->price - round(($product->price * $discountPercent) / 100)
                : $product->price;

            return $finalPrice * $cartItem->quantity;
        });

        $totalQuantity = $orderItems->sum('quantity');
        $shippingCost = 0;
        $total = $subtotal + $shippingCost;
    @endphp

    <main class="bg-[#f5f1ea] py-12 sm:py-14 lg:py-16">
        <section class="mx-auto max-w-7xl px-6 lg:px-12">
            <div class="mb-10 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div class="space-y-3">
                    <span
                        class="inline-flex rounded-full border border-black/10 bg-white px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-black/55">
                        Zavrsni korak
                    </span>
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-black/45">Perfuse porudzbina</p>
                        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-black sm:text-4xl">
                            Pregled i potvrda porudzbine
                        </h1>
                    </div>
                </div>

                <div class="rounded-2xl border border-black/10 bg-white px-5 py-4 shadow-my-shadow">
                    <p class="text-xs uppercase tracking-[0.24em] text-black/45">Ukupno artikala</p>
                    <p class="mt-1 text-2xl font-semibold text-black">{{ $totalQuantity }}</p>
                </div>
            </div>

            @if ($orderItems->isEmpty())
                <div
                    class="rounded-[2rem] border border-dashed border-black/15 bg-white px-6 py-16 text-center shadow-my-shadow">
                    <p class="text-sm uppercase tracking-[0.24em] text-black/45">Nemate proizvode za porucivanje</p>
                    <h2 class="mt-3 text-2xl font-semibold tracking-tight text-black">
                        Dodajte parfeme u korpu kako biste nastavili na stranicu porudzbine.
                    </h2>
                    <a href="{{ route('shopPage') }}" class="btn mt-8 inline-flex px-8 py-3">
                        Nazad u shop
                    </a>
                </div>
            @else
                <form method="POST" action="{{ route('createOrderAPI') }}" class="grid gap-8 xl:grid-cols-[1.15fr_0.85fr]">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $total }}">
                    <input type="hidden" name="total_quantity" value="{{ $totalQuantity }}">
                    <div class="space-y-8">
                        <section
                            class="overflow-hidden rounded-[2rem] border border-black/10 bg-white shadow-[0_28px_80px_rgba(15,23,42,0.08)]">
                            <div class="border-b border-black/10 bg-[#101010] px-7 py-6 text-white sm:px-8">
                                <p class="text-xs uppercase tracking-[0.28em] text-white/55">Podaci za isporuku</p>
                                <h2 class="mt-2 text-2xl font-semibold tracking-tight">Unesite vase podatke</h2>
                            </div>

                            <div class="grid gap-5 px-7 py-7 sm:grid-cols-2 sm:px-8 sm:py-8">
                                <div class="space-y-2">
                                    <label for="name" class="text-sm font-medium text-slate-800">Ime</label>
                                    <input id="name" name="name" type="text" placeholder="Unesite ime" value="Kristijan"
                                        value="{{ old('name') ? old('name') : '' }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">

                                    @if($errors->has('name'))
                                        <p class="text-red-500">* {{ $errors->first('name') }}</p>
                                    @endif

                                    {{-- @error('name')

                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror --}}
                                </div>

                                <div class="space-y-2">
                                    <label for="lastname" class="text-sm font-medium text-slate-800">Prezime</label>
                                    <input id="lastname" name="lastname" type="text" placeholder="Unesite prezime"
                                        value="Stojanovic" value="{{ old('lastname') ? old('lastname') : '' }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                                    @if($errors->has('lastname'))
                                        <p class="text-red-500">* {{ $errors->first('lastname') }}</p>
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    <label for="email" class="text-sm font-medium text-slate-800">Email</label>
                                    <input id="email" name="email" type="email" placeholder="ime@email.com"
                                        value="krimster8@gmail.com" value="{{ old('email') ? old('email') : '' }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                                    @if($errors->has('email'))
                                        <p class="text-red-500">* {{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    <label for="phone_number" class="text-sm font-medium text-slate-800">Telefon</label>
                                    <input id="phone_number" name="phone_number" type="tel" placeholder="+381 60 123 4567"
                                        value="062123123" value="{{ old('phone_number') ? old('phone_number') : '' }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                                    @if($errors->has('phone_number'))
                                        <p class="text-red-500">* {{ $errors->first('phone_number') }}</p>
                                    @endif
                                </div>

                                <div class="space-y-2 sm:col-span-2">
                                    <label for="adress" class="text-sm font-medium text-slate-800">Adresa</label>
                                    <input id="adress" name="adress" type="text" placeholder="Ulica i broj" value="Petrovska"
                                        value="{{ old('adress') ? old('adress') : '' }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                                    @if($errors->has('adress'))
                                        <p class="text-red-500">* {{ $errors->first('adress') }}</p>
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    <label for="city" class="text-sm font-medium text-slate-800">Grad</label>
                                    <input id="city" name="city" type="text" placeholder="Unesite grad" value="Beograd"
                                        value="{{ old('city') ? old('city') : '' }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                                    @if($errors->has('city'))
                                        <p class="text-red-500">* {{ $errors->first('city') }}</p>
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    <label for="postal_code" class="text-sm font-medium text-slate-800">Postanski broj</label>
                                    <input id="postal_code" name="postal_code" type="text" placeholder="11000" value="11000"
                                        value="{{ old('postal_code') ? old('postal_code') : '' }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                                    @if($errors->has('postal_code'))
                                        <p class="text-red-500">* {{ $errors->first('postal_code') }}</p>
                                    @endif
                                </div>

                                <div class="space-y-2 sm:col-span-2">
                                    <label for="note" class="text-sm font-medium text-slate-800">Napomena</label>
                                    <textarea id="note" name="note" rows="4" placeholder="Dodatne informacije za dostavu"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">{{ old('note') }}</textarea>
                                    @error('note')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <section class="rounded-[2rem] border border-black/10 bg-white p-7 shadow-my-shadow sm:p-8">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.24em] text-black/45">Vasi artikli</p>
                                    <h2 class="mt-2 text-2xl font-semibold tracking-tight text-black">
                                        Pregled proizvoda iz korpe
                                    </h2>
                                </div>
                                <a href="{{ route('cartPage') }}"
                                    class="text-sm font-medium text-black/60 transition hover:text-black">
                                    Izmeni korpu
                                </a>
                            </div>

                            <div class="mt-8 space-y-5">
                                @foreach ($orderItems as $key => $cartItem)
                                    @php
                                        $product = $cartItem->product;
                                        $mainImage = $product?->images->firstWhere('is_main_image', true)?->path
                                            ?? $product?->images->first()?->path;
                                        $discountPercent = $product->discount?->discount;
                                        $finalPrice = $discountPercent
                                            ? $product->price - round(($product->price * $discountPercent) / 100)
                                            : $product->price;
                                    @endphp

                                    <input type="hidden" name="products[{{ $key }}][quantity]" value="{{ $cartItem->id }}">
                                    <input type="hidden" name="products[{{ $key }}][product_id]" value="{{ $product->id }}">



                                    <article
                                        class="grid gap-5 rounded-2xl border border-black/10 bg-[#fcfbf8] p-5 sm:grid-cols-[120px_1fr] sm:p-6">
                                        <a href="{{ route('productDetails', $product->id) }}"
                                            class="flex items-center justify-center rounded-2xl bg-white p-4">
                                            @if ($mainImage)
                                                <img src="http://127.0.0.1:8000/Images/ShopPage/Thumbnail/thumbnail.jpg"
                                                    alt="{{ $product->brand?->title }} {{ $product->title }}"
                                                    class="aspect-square w-full max-w-[96px] object-contain">
                                            @else
                                                <div
                                                    class="flex aspect-square w-full max-w-[96px] items-center justify-center rounded-xl border border-dashed border-black/15 bg-stone-50 text-[11px] uppercase tracking-[0.2em] text-black/35">
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
                                                    <h3 class="mt-1 text-2xl font-semibold tracking-tight text-black">
                                                        {{ $product->title }}
                                                    </h3>
                                                </div>

                                                <div class="text-left sm:text-right">
                                                    <p class="text-xl font-semibold text-black">
                                                        {{ number_format($finalPrice * $cartItem->quantity, 0, ',', '.') }} RSD
                                                    </p>
                                                    <p class="text-sm text-black/50">
                                                        {{ number_format($finalPrice, 0, ',', '.') }} RSD po komadu
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap gap-3 text-sm">
                                                <span class="rounded-md bg-black px-3 py-2 uppercase tracking-[0.18em] text-white">
                                                    {{ $product->gender }}
                                                </span>
                                                <span class="rounded-md border border-black/10 px-3 py-2 text-black/70">
                                                    {{ $product->waterType?->type ?? 'Bez tipa' }}
                                                </span>
                                                <span class="rounded-md border border-black/10 px-3 py-2 text-black/70">
                                                    Kolicina: {{ $cartItem->quantity }}
                                                </span>
                                                @if ($discountPercent)
                                                    <span class="rounded-md bg-emerald-50 px-3 py-2 text-emerald-700">
                                                        Popust {{ $discountPercent }}%
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <aside class="space-y-6">
                        <div
                            class="overflow-hidden rounded-[2rem] border border-black/10 bg-white shadow-[0_28px_80px_rgba(15,23,42,0.08)] xl:sticky xl:top-8">
                            <div class="bg-[#101010] px-7 py-6 text-white sm:px-8">
                                <p class="text-xs uppercase tracking-[0.28em] text-white/55">Rezime</p>
                                <h2 class="mt-2 text-2xl font-semibold tracking-tight">Vasa porudzbina</h2>
                            </div>

                            <div class="space-y-6 px-7 py-7 sm:px-8 sm:py-8">
                                <div class="grid gap-4">
                                    <div class="rounded-2xl bg-stone-100 p-4">
                                        <p class="text-xs uppercase tracking-[0.22em] text-black/45">Broj proizvoda</p>
                                        <p class="mt-2 text-2xl font-semibold text-black">{{ $orderItems->count() }}</p>
                                    </div>

                                    <div class="rounded-2xl bg-stone-100 p-4">
                                        <p class="text-xs uppercase tracking-[0.22em] text-black/45">Nacin placanja</p>
                                        <p class="mt-2 text-lg font-medium text-black">Pouzecem pri preuzimanju</p>
                                    </div>
                                </div>

                                <div class="space-y-4 border-y border-black/10 py-6">
                                    <div class="flex items-center justify-between text-sm text-black/60">
                                        <span>Subtotal</span>
                                        <span>{{ number_format($subtotal, 0, ',', '.') }} RSD</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm text-black/60">
                                        <span>Dostava</span>
                                        <span>{{ $shippingCost === 0 ? 'Besplatna' : number_format($shippingCost, 0, ',', '.') . ' RSD' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-lg font-semibold text-black">
                                        <span>Ukupno za uplatu</span>
                                        <span>{{ number_format($total, 0, ',', '.') }} RSD</span>
                                    </div>
                                </div>



                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-2xl bg-[#101010] px-6 py-4 text-sm font-semibold text-white transition hover:bg-black focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                                    Potvrdite porudzbinu
                                </button>

                                <a href="{{ route('shopPage') }}"
                                    class="block text-center text-sm font-medium text-black/55 transition hover:text-black">
                                    Nastavite kupovinu
                                </a>
                            </div>
                        </div>
                    </aside>
                </form>
            @endif
        </section>
    </main>
@endsection