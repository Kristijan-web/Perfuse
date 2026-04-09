@extends('layouts.admin')

@section('title', "Contact Response")


@section('content')
    <div class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">Admin Panel</p>
                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Odgovori na kontakt zahtev</h1>
                    <p class="mt-2 text-sm text-slate-600">Pregledajte poruku korisnika i pošaljite jasan odgovor sa jednog
                        mesta.
                    </p>
                </div>
                <a href="#"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-400 hover:bg-slate-50">
                    Nazad u prijemno sanduče
                </a>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1.05fr_1.4fr]">
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">Poslata poruka
                            </p>
                            <h2 class="mt-2 text-xl font-semibold text-slate-900">Detalji kontakta</h2>
                        </div>
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Odgovor
                            na čekanju</span>
                    </div>

                    <div class="mt-6 space-y-5">
                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Korisnik</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">
                                {{ $contact->user?->name ?? 'Nepoznat korisnik' }}
                            </p>
                            <p class="mt-1 text-sm text-slate-600">{{ $contact->user?->email ?? 'Email nije dostupan' }}</p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-xl border border-slate-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Naslov</p>
                                <p class="mt-2 text-sm font-medium text-slate-800">{{ $contact->title }}</p>
                            </div>
                            <div class="rounded-xl border border-slate-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Primljeno</p>
                                <p class="mt-2 text-sm font-medium text-slate-800">
                                    {{ $contact->created_at?->format('M d, Y \\a\\t h:i A') }}
                                </p>
                            </div>
                        </div>

                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Poruka</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700">
                                {{ $contact->text }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-emerald-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Interna napomena</p>
                            <p class="mt-2 text-sm text-emerald-900">
                                Veoma zainteresovan potencijalni klijent. U odgovoru pomenite podršku pri uvođenju i
                                ponudite kratak demo poziv.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Pisanje odgovora</p>
                            <h2 class="mt-2 text-xl font-semibold text-slate-900">Pošalji odgovor</h2>
                        </div>
                        <div class="text-right">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Dodeljeno</p>
                            <p class="mt-1 text-sm font-semibold text-slate-800">Admin timu</p>
                        </div>
                    </div>

                    <form class="mt-6 space-y-5">
                        <div>
                            <label for="recipient" class="mb-2 block text-sm font-medium text-slate-700">Primalac</label>
                            <input id="recipient" type="email" value="{{ $contact->user?->email ?? '' }}"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none ring-0 transition placeholder:text-slate-400 focus:border-sky-500">
                        </div>

                        <div>
                            <label for="reply-subject" class="mb-2 block text-sm font-medium text-slate-700">Naslov</label>
                            <input id="reply-subject" type="text" value="Odg: {{ $contact->title }}"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none ring-0 transition placeholder:text-slate-400 focus:border-sky-500">
                        </div>

                        <div>
                            <label for="response" class="mb-2 block text-sm font-medium text-slate-700">Odgovor</label>
                            <textarea id="response" rows="12"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none ring-0 transition placeholder:text-slate-400 focus:border-sky-500"
                                placeholder="Napišite odgovor ovde...">Zdravo {{ $contact->user?->name ?? 'tamo' }},

            Hvala vam što ste nas kontaktirali u vezi sa "{{ $contact->title }}". Biće nam drago da vam pomognemo i pošaljemo dodatne informacije.

            Slobodno nam javite ako želite da podelite još neke detalje kako bismo vam efikasnije pomogli.

            Srdačan pozdrav,
            Admin tim</textarea>
                        </div>

                        <div class="grid gap-5 rounded-2xl bg-slate-50 p-4 sm:grid-cols-2">
                            <label
                                class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700">
                                <input type="checkbox"
                                    class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                                Pošalji kopiju u podršku
                            </label>
                            <label
                                class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700">
                                <input type="checkbox" checked
                                    class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                                Označi zahtev kao rešen nakon slanja
                            </label>
                        </div>

                        <div class="flex flex-col gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                            <button type="button"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                                Sačuvaj nacrt
                            </button>
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                                Pošalji odgovor
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

@endsection