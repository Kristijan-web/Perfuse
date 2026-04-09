@extends('layouts.admin')

@section('title', 'Kreiraj proizvod')


@section('content')
    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Kreiraj proizvod</h1>
                <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                    Dodaj novi proizvod sa osnovnim podacima, dostupnim velicinama, slikama i opcionalnim podesavanjima popusta.
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <form method="POST" action="{{ route('createProductAPI') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="lg:col-span-2">
                            <label for="title" class="mb-2 block text-sm font-semibold text-slate-700">Naziv proizvoda</label>
                            <input id="title" name="title" type="text" value="{{ old('title') }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="Unesi naziv proizvoda" required>
                            @error('title')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">Cena</label>
                            <input id="price" name="price" type="number" min="0" step="1" value="{{ old('price') }}"
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
                                    <option value="{{ $value }}" @selected(old('gender') === $value)>{{ $label }}</option>
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
                                    <option value="{{ $brand->id }}" @selected((string) old('brand_id') === (string) $brand->id)>
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
                                        @selected((string) old('water_type_id') === (string) $waterType->id)>
                                        {{ $waterType->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('water_type_id')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="images" class="mb-2 block text-sm font-semibold text-slate-700">Slike proizvoda</label>
                            <input id="images" name="images[]" type="file" accept="image/*" multiple
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 file:mr-4 file:rounded-xl file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-700">
                            <p class="mt-2 text-sm text-slate-500">Mozes da otpremis vise slika. Koristi prvu sliku kao glavnu.</p>
                            @error('images')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
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
                                        {{ in_array($ml->id, old('mls', [])) ? 'checked' : '' }}>
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

                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">Podesavanja popusta</h2>
                                <p class="mt-1 text-sm text-slate-500">Ukljuci popust samo ako ovaj proizvod odmah ide na akciju.</p>
                            </div>

                            <label
                                class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700">
                                <input id="has_discount" name="has_discount" type="checkbox" value="1"
                                    class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                                    {{ old('has_discount') ? 'checked' : '' }}>
                                <span>Primeni popust</span>
                            </label>
                        </div>

                        <div id="discount-fields" class="{{ old('has_discount') ? '' : 'hidden' }} mt-5 grid gap-6 lg:grid-cols-3">
                            <div>
                                <label for="discount" class="mb-2 block text-sm font-semibold text-slate-700">Procenat popusta</label>
                                <input id="discount" name="discount" type="number" min="1" max="100" step="1"
                                    value="{{ old('discount') }}"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                    placeholder="npr. 20">
                                @error('discount')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="start_date" class="mb-2 block text-sm font-semibold text-slate-700">Datum pocetka</label>
                                <input id="start_date" name="start_date" type="datetime-local" value="{{ old('start_date') }}"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                                @error('start_date')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_date" class="mb-2 block text-sm font-semibold text-slate-700">Datum kraja</label>
                                <input id="end_date" name="end_date" type="datetime-local" value="{{ old('end_date') }}"
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
                            Kreiraj proizvod
                        </button>
                    </div>
                </form>
            </div>
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
                discountFields.classList.toggle('hidden', !discountToggle.checked);
            };

            toggleDiscountFields();
            discountToggle.addEventListener('change', toggleDiscountFields);
        });
    </script>

@endsection
