@extends('layouts.user')

@section('title', 'Contact')

@section('content')
    <main class="bg-[#f5f1ea] px-4 py-16 sm:px-6 lg:px-8">
        <section
            class="mx-auto max-w-4xl overflow-hidden rounded-[2rem] border border-black/10 bg-white shadow-[0_30px_80px_rgba(15,23,42,0.12)]">
            <div class="grid lg:grid-cols-[0.95fr_1.05fr]">
                <div class="relative overflow-hidden bg-[#101010] px-8 py-12 text-white sm:px-10 lg:px-12">
                    <div
                        class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.18),_transparent_45%)]">
                    </div>
                    <div class="relative space-y-6">
                        <span
                            class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                            Kontakt
                        </span>

                        <div class="space-y-4">
                            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">
                                Pišite nam bez čekanja.
                            </h1>
                            <p class="max-w-md text-sm leading-7 text-white/70 sm:text-base">
                                Pošaljite naslov i poruku, a naš tim će vam odgovoriti što pre.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-12 sm:px-10 lg:px-12">
                    <form class="space-y-6">
                        <div class="space-y-2">
                            <label for="contact-title" class="text-sm font-medium text-slate-800">
                                Naslov
                            </label>
                            <input id="contact-title" name="title" type="text" placeholder="Unesite naslov poruke"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                        </div>

                        <div class="space-y-2">
                            <label for="contact-text" class="text-sm font-medium text-slate-800">
                                Tekst
                            </label>
                            <textarea id="contact-text" name="text" rows="8" placeholder="Napišite vašu poruku..."
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70"></textarea>
                        </div>

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-[#101010] px-6 py-3 text-sm font-semibold text-white transition hover:bg-black focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 sm:w-auto">
                            Pošalji poruku
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection