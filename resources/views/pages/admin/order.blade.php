@extends('layouts.admin')

@section('title', 'Porudzbine')


@section('content')
    @php
        $userRecords = $orders instanceof \Illuminate\Database\Eloquent\Builder ? $orders->get() : collect($orders);
        $orderRecords = $userRecords->flatMap(function ($user) {
            return ($user->orders ?? collect())->map(function ($order) use ($user) {
                $order->resolved_user = $user;

                return $order;
            });
        })->values();
    @endphp

    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Pregled porudzbina</h1>
                        <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                            Pregledaj sve porudzbine kupaca zajedno sa vlasnistvom naloga i detaljima kupovine.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Ukupno porudzbina</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $orderRecords->count() }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Kupci</p>
                            <p class="mt-2 text-2xl font-semibold">
                                {{ $userRecords->filter(fn($user) => ($user->orders?->count() ?? 0) > 0)->count() }}
                            </p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Prihod</p>
                            <p class="mt-2 text-2xl font-semibold">
                                ${{ number_format($orderRecords->sum('total_price'), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div
                    class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Tabela porudzbina</h2>
                        <p class="text-sm text-slate-500">Sve porudzbine koje su trenutno dostupne u admin pregledu.</p>
                    </div>
                    <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                        {{ $orderRecords->count() }} zapisa
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                                <th class="px-6 py-4">Porudzbina</th>
                                <th class="px-6 py-4">Kupac</th>
                                <th class="px-6 py-4">Kontakt</th>
                                <th class="px-6 py-4">Dostava</th>
                                <th class="px-6 py-4">Ukupno</th>
                                <th class="px-6 py-4">Kreirano</th>
                                <th class="px-6 py-4 text-right">Akcije</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($orderRecords as $order)
                                <tr class="align-top transition hover:bg-slate-50/80">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-semibold text-slate-900">#{{ $order->id }}</p>
                                            <p class="text-sm text-slate-500">
                                                {{ trim(($order->name ?? '') . ' ' . ($order->lastname ?? '')) ?: 'Nema imena primaoca' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-slate-900">
                                                {{ $order->resolved_user?->name ?? 'Gost porudzbina' }}
                                            </p>
                                            <p class="text-sm text-slate-500">
                                                ID korisnika: {{ $order->resolved_user?->id ?? ($order->user_id ?? 'Nije dostupno') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <div class="space-y-1">
                                            <p>{{ $order->email ?? 'Nema emaila' }}</p>
                                            <p class="text-slate-500">{{ $order->phone_number ?? 'Nema broja telefona' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <div class="max-w-xs space-y-1">
                                            <p>{{ $order->adress ?? 'Nema adrese' }}</p>
                                            <p class="text-slate-500">
                                                {{ collect([$order->city ?? null, $order->postal_code ?? null])->filter()->implode(', ') ?: 'Nema grada ili postanskog broja' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <div class="space-y-1">
                                            <p class="font-semibold text-slate-900">
                                                ${{ number_format((float) ($order->total_price ?? 0), 2) }}</p>
                                            <p class="text-slate-500">{{ $order->total_quantity ?? 0 }} stavki</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $order->created_at?->format('M d, Y H:i') ?? 'Nije dostupno' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button type="button"
                                                class="inline-flex items-center rounded-xl border border-sky-300 px-4 py-2 text-sm font-medium text-sky-700 transition hover:border-sky-400 hover:bg-sky-50">
                                                Detalji
                                            </button>
                                            <button type="button"
                                                class="inline-flex items-center rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                                                Izmeni
                                            </button>
                                            <form method="POST" action="{{ route('deleteOrderAPI', $order->id) }}">
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
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-md">
                                            <div
                                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                                                0
                                            </div>
                                            <h3 class="mt-4 text-lg font-semibold text-slate-900">Nema pronadjenih porudzbina</h3>
                                            <p class="mt-2 text-sm text-slate-500">
                                                Porudzbine ce se pojaviti ovde kada kupci zavrse kupovinu.
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
