@extends('layouts.admin')

@section('title', 'Kontakt forme')

@section('content')
    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Kontakt poruke</h1>
                        <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                            Pregledaj svaku poruku poslatu kroz kontakt formu, zajedno sa korisnikom koji ju je poslao.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Ukupno poruka</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $contacts->count() }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Jedinstveni korisnici</p>
                            <p class="mt-2 text-2xl font-semibold">
                                {{ $contacts->pluck('user_id')->filter()->unique()->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div
                    class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Tabela poruka</h2>
                        <p class="text-sm text-slate-500">Sve poruke sa kontakt forme koje su trenutno sacuvane u bazi.</p>
                    </div>
                    <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                        {{ $contacts->count() }} zapisa
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                                <th class="px-6 py-4">Naslov</th>
                                <th class="px-6 py-4">Poruka</th>
                                <th class="px-6 py-4">Korisnik</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Poslato</th>
                                <th class="px-6 py-4 text-right">Akcije</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($contacts as $contact)
                                <tr class="align-top transition hover:bg-slate-50/80">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $contact->title }}</p>
                                            <p class="text-sm text-slate-500">ID: {{ $contact->id }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-6 text-slate-700">
                                        <div class="max-w-xl whitespace-pre-line">
                                            {{ $contact->text }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $contact->user?->name ?? 'Obrisan korisnik' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $contact->user?->email ?? 'Nema emaila' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $contact->created_at?->format('M d, Y H:i') ?? 'Nije dostupno' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('adminResponseSubmissionsPage', $contact->id)}}"
                                                class="inline-flex items-center rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                                                Odgovori
                                            </a>
                                            <form method="POST" action="{{ route('deleteContactAPI', $contact->id) }}">
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
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-md">
                                            <div
                                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                                                0
                                            </div>
                                            <h3 class="mt-4 text-lg font-semibold text-slate-900">Nema pronadjenih poruka</h3>
                                            <p class="mt-2 text-sm text-slate-500">
                                                Zapisi kontakt forme ce se pojaviti ovde kada korisnici pocnu da salju poruke.
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