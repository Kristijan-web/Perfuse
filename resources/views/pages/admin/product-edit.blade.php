@extends('layouts.admin')


@section('title', 'Edit product')


@section('content')
    @php
        $resolvedProduct = $productData ?? null;
        $brands = $brands ?? \App\Models\Brand::all();
        $waterTypes = $waterTypes ?? \App\Models\WaterType::all();
        $mls = $mls ?? \App\Models\Ml::all();
        $selectedMlIds = old('mls', $resolvedProduct?->mls?->pluck('id')->map(fn ($id) => (string) $id)->all() ?? []);
        $selectedMainImageId = (string) old('main_image_id', $resolvedProduct?->images?->firstWhere('is_main_image', true)?->id ?? $resolvedProduct?->images?->first()?->id);
        $hasDiscount = old('has_discount', $resolvedProduct?->discount ? '1' : null);
        $updateRouteExists = $resolvedProduct && \Illuminate\Support\Facades\Route::has('editProductAPI');
    @endphp

    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Izmena proizvoda</h1>
                <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                    Azuriraj postojece podatke o proizvodu kroz istu formu koja se koristi za kreiranje, uz vec unete vrednosti.
                </p>
            </div>

            @if ($resolvedProduct)
                <div class="grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(260px,1fr)]">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <form method="POST"
                            action="{{ route('editProductAPI', $resolvedProduct->id) }}"
                            enctype="multipart/form-data" class="space-y-8">
                            @csrf
                     
                            @method('PUT')
                       

                            <div class="grid gap-6 lg:grid-cols-2">
                                <div class="lg:col-span-2">
                                    <label for="title" class="mb-2 block text-sm font-semibold text-slate-700">Naziv proizvoda</label>
                                    <input id="title" name="title" type="text" value="{{ old('title', $resolvedProduct->title) }}"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                        placeholder="Unesi naziv proizvoda" required>
                                    @error('title')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">Cena</label>
                                    <input id="price" name="price" type="number" min="0" step="1" value="{{ old('price', $resolvedProduct->price) }}"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                        placeholder="Unesi cenu" required>
                                    @error('price')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="mb-2 block text-sm font-semibold text-slate-700">Pol</label>
                                    <select id="gender" name="gender"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                        required>
                                        <option value="">Izaberi pol</option>
                                        @foreach (['muski' => 'Muski', 'zenski' => 'Zenski'] as $value => $label)
                                            <option value="{{ $value }}" @selected(old('gender', $resolvedProduct->gender) === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="brand_id" class="mb-2 block text-sm font-semibold text-slate-700">Brend</label>
                                    <select id="brand_id" name="brand_id"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                        required>
                                        <option value="">Izaberi brend</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                @selected((string) old('brand_id', $resolvedProduct->brand_id) === (string) $brand->id)>
                                                {{ $brand->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="water_type_id" class="mb-2 block text-sm font-semibold text-slate-700">Tip vode</label>
                                    <select id="water_type_id" name="water_type_id"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                        required>
                                        <option value="">Izaberi tip vode</option>
                                        @foreach ($waterTypes as $waterType)
                                            <option value="{{ $waterType->id }}"
                                                @selected((string) old('water_type_id', $resolvedProduct->water_type_id) === (string) $waterType->id)>
                                                {{ $waterType->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('water_type_id')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 lg:col-span-2">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h2 class="text-lg font-semibold text-slate-900">Dostupne velicine</h2>
                                            <p class="mt-1 text-sm text-slate-500">Izaberi jednu ili vise velicina bocice za ovaj proizvod.</p>
                                        </div>
                                    </div>

                                    <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                                        @foreach ($mls as $ml)
                                            <label
                                                class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 transition hover:border-slate-300">
                                                <input type="checkbox" name="mls[]" value="{{ $ml->id }}"
                                                    class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                                                    {{ in_array((string) $ml->id, $selectedMlIds, true) ? 'checked' : '' }}>
                                                <span>{{ $ml->size_ml }} ml</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('mls')
                                        <p class="mt-3 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                    @error('mls.*')
                                        <p class="mt-3 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="images" class="mb-2 block text-sm font-semibold text-slate-700">Slike proizvoda</label>
                                    <input id="images" name="images[]" type="file" accept="image/*" multiple
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 file:mr-4 file:rounded-xl file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-700">
                                    <p class="mt-2 text-sm text-slate-500">Dodaj nove slike po potrebi. Postojece slike ostaju prikazane ispod. Prva izabrana slika ce biti prikazana u shop-u</p>
                                    @error('images')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                    @error('images.*')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                                <div class="flex flex-col gap-4">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <h2 class="text-lg font-semibold text-slate-900">Postojece slike</h2>
                                            <p class="mt-1 text-sm text-slate-500">Pregledaj trenutne slike i izaberi koja je glavna za prikaz.</p>
                                        </div>
                                        <div class="rounded-full bg-white px-4 py-2 text-sm font-medium text-slate-600 ring-1 ring-slate-200">
                                            {{ $resolvedProduct->images?->count() ?? 0 }} slika
                                        </div>
                                    </div>

                                    <div>
                                        <label for="main_image_id" class="mb-2 block text-sm font-semibold text-slate-700">Glavna slika</label>
                                        <select id="main_image_id" name="main_image_id"
                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                                            <option value="">Izaberi glavnu sliku</option>
                                            @foreach (($resolvedProduct->images ?? []) as $image)
                                                <option value="{{ $image->id }}" @selected($selectedMainImageId === (string) $image->id)>
                                                    Slika #{{ $loop->iteration }}{{ $image->is_main_image ? ' - trenutno glavna' : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('main_image_id')
                                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @if ($resolvedProduct->images?->isNotEmpty())
                                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                            @foreach ($resolvedProduct->images as $image)
                                                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white p-3">
                                                    <img src="{{ asset($image->path) }}" alt="{{ $resolvedProduct->title }}"
                                                        class="h-44 w-full rounded-2xl object-cover">
                                                    <p class="mt-3 text-sm font-medium text-slate-700">
                                                        Slika #{{ $loop->iteration }}{{ $image->is_main_image ? ' - trenutno glavna' : '' }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div
                                            class="flex h-52 items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white text-sm font-medium text-slate-400">
                                            Nema dostupnih slika
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Podesavanja popusta</h2>
                                        <p class="mt-1 text-sm text-slate-500">Ukljuci popust samo ako ovaj proizvod trenutno treba da bude na akciji.</p>
                                    </div>

                                    <label
                                        class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700">
                                        <input id="has_discount" name="has_discount" type="checkbox" value="1"
                                            class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                                            {{ $hasDiscount ? 'checked' : '' }}>
                                        <span>Primeni popust</span>
                                    </label>
                                </div>

                                <div id="discount-fields" class="{{ $hasDiscount ? '' : 'hidden' }} mt-5 grid gap-6 lg:grid-cols-3">
                                    <div>
                                        <label for="discount" class="mb-2 block text-sm font-semibold text-slate-700">Procenat popusta</label>
                                        <input id="discount" name="discount" type="number" min="1" max="100" step="1"
                                            value="{{ old('discount', $resolvedProduct->discount?->discount) }}"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                            placeholder="npr. 20">
                                        @error('discount')
                                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="start_date" class="mb-2 block text-sm font-semibold text-slate-700">Datum pocetka</label>
                                        <input id="start_date" name="start_date" type="datetime-local"
                                            value="{{ old('start_date', $resolvedProduct->discount?->start_date ? \Illuminate\Support\Carbon::parse($resolvedProduct->discount->start_date)->format('Y-m-d\\TH:i') : '') }}"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                                        @error('start_date')
                                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="end_date" class="mb-2 block text-sm font-semibold text-slate-700">Datum kraja</label>
                                        <input id="end_date" name="end_date" type="datetime-local"
                                            value="{{ old('end_date', $resolvedProduct->discount?->end_date ? \Illuminate\Support\Carbon::parse($resolvedProduct->discount->end_date)->format('Y-m-d\\TH:i') : '') }}"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                                        @error('end_date')
                                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ url('/admin') }}"
                                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                                    Otkazi
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-400">
                                    Sacuvaj izmene
                                </button>
                            </div>
                        </form>
                    </div>

                    <aside class="space-y-4">
                        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Detalji proizvoda</p>
                            <dl class="mt-4 space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">ID proizvoda</dt>
                                    <dd class="mt-1 text-base font-semibold text-slate-900">{{ $resolvedProduct->id }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Brend</dt>
                                    <dd class="mt-1 text-base font-semibold text-slate-900">{{ $resolvedProduct->brand?->title ?? 'Bez brenda' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Tip vode</dt>
                                    <dd class="mt-1 text-base font-semibold text-slate-900">{{ $resolvedProduct->waterType?->type ?? 'Bez tipa vode' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Broj slika</dt>
                                    <dd class="mt-1 text-base font-semibold text-slate-900">{{ $resolvedProduct->images?->count() ?? 0 }}</dd>
                                </div>
                            </dl>
                        </div>
                    </aside>
                </div>

            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const discountToggle = document.getElementById('has_discount');
            const discountFields = document.getElementById('discount-fields');

            if (!discountToggle || !discountFields) {
                return;
            }

            const toggleDiscountFields = () => {
                const hasDiscount = discountToggle.type === 'checkbox' ? discountToggle.checked : discountToggle.value === '1';
                discountFields.classList.toggle('hidden', !hasDiscount);
            };

            toggleDiscountFields();
            discountToggle.addEventListener('change', toggleDiscountFields);
        });
    </script>

@endsection
