@extends('layouts.admin')

@section('title', 'Proizvodi')

@section('content')
    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Pregled proizvoda</h1>
                        <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                            Pregledaj sve proizvode na jednom mestu, sa kljucnim podacima za brze admin akcije.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-stretch">
                        <a href="{{ route('adminCreateProductPage') }}"
                            class="inline-flex items-center justify-center rounded-2xl bg-emerald-500 px-5 py-4 text-sm font-semibold text-white transition hover:bg-emerald-400">
                            Kreiraj novi proizvod
                        </a>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Ukupno proizvoda</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $products->count() }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Na popustu</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $products->whereNotNull('discount_id')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div
                    class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Tabela proizvoda</h2>
                        <p class="text-sm text-slate-500">Svi trenutno dostupni zapisi proizvoda iz baze.</p>
                    </div>
                    <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                        {{ $products->count() }} zapisa
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                                <th class="px-6 py-4">Proizvod</th>
                                <th class="px-6 py-4">Brend</th>
                                <th class="px-6 py-4">Tip vode</th>
                                <th class="px-6 py-4">Dostupno ml</th>
                                <th class="px-6 py-4">Pol</th>
                                <th class="px-6 py-4">Cena</th>
                                <th class="px-6 py-4">Popust</th>
                                <th class="px-6 py-4">Slika</th>
                                <th class="px-6 py-4 text-right">Akcije</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($products as $product)
                                @php
                                    $discountedPrice = $product->discount?->discount
                                        ? $product->price - round(($product->price * $product->discount->discount) / 100)
                                        : null;
                                    $mainImage = $product->images->firstWhere('is_main_image', true)?->path
                                        ?? $product->images->first()?->path;
                                @endphp
                                <tr class="align-top transition hover:bg-slate-50/80">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $product->title }}</p>
                                            <p class="text-sm text-slate-500">ID: {{ $product->id }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $product->brand?->title ?? 'Bez brenda' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $product->waterType?->type ?? 'Bez tipa' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        @if ($product->mls->isNotEmpty())
                                            {{ $product->mls->pluck('size_ml')->map(fn($size) => $size . ' ml')->implode(', ') }}
                                        @else
                                            Nema ml
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700">
                                            {{ $product->gender }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-900">
                                        @if ($discountedPrice !== null)
                                            <div class="space-y-1">
                                                <p class="text-xs font-medium uppercase tracking-wide text-slate-400 line-through">
                                                    ${{ number_format($product->price, 2) }}
                                                </p>
                                                <p class="font-semibold text-emerald-600">
                                                    ${{ number_format($discountedPrice, 2) }}
                                                </p>
                                            </div>
                                        @else
                                            <p class="font-semibold">${{ number_format($product->price, 2) }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($product->discount)
                                            <span
                                                class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                {{ $product->discount->discount }}% popusta
                                            </span>
                                        @else
                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                                Nema
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        @if ($mainImage)
                                            <img src="{{ $mainImage }}" alt="{{ $product->title }}"
                                                class="h-16 w-16 rounded-2xl object-cover ring-1 ring-slate-200">
                                        @else
                                            <span class="text-slate-400">Nema slike</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button type="button"
                                                class="inline-flex items-center rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                                                Izmeni
                                            </button>
                                            <form method="POST" action="{{ route('deleteProductAPI', $product->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="cursor-pointer inline-flex items-center rounded-xl bg-rose-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-rose-700">
                                                    Obrisi
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-md">
                                            <div
                                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                                                0
                                            </div>
                                            <h3 class="mt-4 text-lg font-semibold text-slate-900">Nema pronadjenih proizvoda</h3>
                                            <p class="mt-2 text-sm text-slate-500">
                                                Proizvodi ce se pojaviti ovde kada zapisi budu dostupni u bazi.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
