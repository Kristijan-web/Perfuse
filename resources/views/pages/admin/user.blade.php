@extends('layouts.admin')

@section('title', 'Korisnici')

@section('content')

    @php
        $userRecords = $users instanceof \Illuminate\Database\Eloquent\Builder ? $users->get() : $users;
    @endphp

    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Pregled korisnika</h1>
                        <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                            Pregledaj registrovane korisnike i status njihovih naloga na jednom mestu.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-stretch">
                        <a href="{{ route('adminCreateUserPage') }}"
                            class="inline-flex items-center justify-center rounded-2xl bg-emerald-500 px-5 py-4 text-sm font-semibold text-white transition hover:bg-emerald-400">
                            Dodaj novog korisnika
                        </a>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Ukupno korisnika</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $userRecords->count() }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Potvrdjeni emailovi</p>
                            <p class="mt-2 text-2xl font-semibold">
                                {{ $userRecords->whereNotNull('email_verified_at')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div
                    class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Tabela korisnika</h2>
                        <p class="text-sm text-slate-500">Svi korisnicki zapisi koji se trenutno nalaze u bazi.</p>
                    </div>
                    <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                        {{ $userRecords->count() }} zapisa
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                                <th class="px-6 py-4">Korisnik</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Uloga</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Kreiran</th>
                                <th class="px-6 py-4 text-right">Akcije</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($userRecords as $user)
                                <tr class="align-top transition hover:bg-slate-50/80">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                                            <p class="text-sm text-slate-500">ID: {{ $user->id }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-700">{{ $user->role?->name ?? 'Bez uloge' }}</td>
                                    <td class="px-6 py-4">
                                        @if ($user->email_verified_at)
                                            <span
                                                class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                Potvrdjen
                                            </span>
                                        @else
                                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                Na cekanju
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $user->created_at?->format('M d, Y') ?? 'Nije dostupno' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button type="button"
                                                class="inline-flex items-center rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                                                Izmeni
                                            </button>
                                            <form method="POST" action="{{ route('deleteUserAPI', $user->id) }}">
                                                @csrf
                                                @method("DELETE")
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
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-md">
                                            <div
                                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                                                0
                                            </div>
                                            <h3 class="mt-4 text-lg font-semibold text-slate-900">Nema pronadjenih korisnika</h3>
                                            <p class="mt-2 text-sm text-slate-500">
                                                Zapisi korisnika ce se pojaviti ovde kada nalozi budu postojali u bazi.
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
