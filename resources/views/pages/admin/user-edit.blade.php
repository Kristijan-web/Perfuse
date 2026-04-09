@extends('layouts.admin')

@section('title', 'Izmeni korisnika')

@section('content')
    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Izmena korisnika</h1>
                <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                    Pregledaj i azuriraj osnovne informacije o korisnickom nalogu.
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(260px,1fr)]">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <form method="POST" action="{{ route('editUserAPI', $user->id) }}" class="space-y-6">
                        @csrf
                        @method("PATCH")

                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Ime i prezime</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="Unesi ime i prezime" required>
                            @error('name')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email adresa</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="Unesi email adresu" required>
                            @error('email')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Nova
                                lozinka</label>
                            <input id="password" name="password" type="password"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="Ostavi prazno ako ne menjas lozinku">
                            @error('password')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ url('/admin/users') }}"
                                class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                                Nazad
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
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Podaci o nalogu</p>
                        <dl class="mt-4 space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Korisnicki ID</dt>
                                <dd class="mt-1 text-base font-semibold text-slate-900">{{ $user->id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Trenutno ime</dt>
                                <dd class="mt-1 text-base font-semibold text-slate-900">{{ $user->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Trenutni email</dt>
                                <dd class="mt-1 break-all text-base font-semibold text-slate-900">{{ $user->email }}</dd>
                            </div>
                            @if (!empty($user->created_at))
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Datum kreiranja</dt>
                                    <dd class="mt-1 text-base font-semibold text-slate-900">
                                        {{ $user->created_at->format('d.m.Y. H:i') }}
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <div class="rounded-3xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                        <p class="text-sm font-semibold text-amber-900">Napomena</p>
                        <p class="mt-2 text-sm leading-6 text-amber-800">
                            Lozinku unesi samo ako zelis da postavis novu vrednost za ovog korisnika.
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection