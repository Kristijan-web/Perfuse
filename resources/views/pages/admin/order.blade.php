@extends('layouts.admin')

@section('title', 'Orders')


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
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin Panel</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Orders overview</h1>
                        <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                            Review all customer orders together with account ownership and checkout details.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Total orders</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $orderRecords->count() }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Customers</p>
                            <p class="mt-2 text-2xl font-semibold">
                                {{ $userRecords->filter(fn($user) => ($user->orders?->count() ?? 0) > 0)->count() }}
                            </p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Revenue</p>
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
                        <h2 class="text-lg font-semibold text-slate-900">Order table</h2>
                        <p class="text-sm text-slate-500">All orders currently available from the admin order dataset.</p>
                    </div>
                    <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                        {{ $orderRecords->count() }} records
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                                <th class="px-6 py-4">Order</th>
                                <th class="px-6 py-4">Customer</th>
                                <th class="px-6 py-4">Contact</th>
                                <th class="px-6 py-4">Shipping</th>
                                <th class="px-6 py-4">Totals</th>
                                <th class="px-6 py-4">Placed</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($orderRecords as $order)
                                <tr class="align-top transition hover:bg-slate-50/80">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-semibold text-slate-900">#{{ $order->id }}</p>
                                            <p class="text-sm text-slate-500">
                                                {{ trim(($order->name ?? '') . ' ' . ($order->lastname ?? '')) ?: 'No recipient name' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-slate-900">
                                                {{ $order->resolved_user?->name ?? 'Guest order' }}
                                            </p>
                                            <p class="text-sm text-slate-500">
                                                User ID: {{ $order->resolved_user?->id ?? ($order->user_id ?? 'N/A') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <div class="space-y-1">
                                            <p>{{ $order->email ?? 'No email' }}</p>
                                            <p class="text-slate-500">{{ $order->phone_number ?? 'No phone number' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <div class="max-w-xs space-y-1">
                                            <p>{{ $order->adress ?? 'No address' }}</p>
                                            <p class="text-slate-500">
                                                {{ collect([$order->city ?? null, $order->postal_code ?? null])->filter()->implode(', ') ?: 'No city or postal code' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <div class="space-y-1">
                                            <p class="font-semibold text-slate-900">
                                                ${{ number_format((float) ($order->total_price ?? 0), 2) }}</p>
                                            <p class="text-slate-500">{{ $order->total_quantity ?? 0 }} items</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $order->created_at?->format('M d, Y H:i') ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button type="button"
                                                class="inline-flex items-center rounded-xl border border-sky-300 px-4 py-2 text-sm font-medium text-sky-700 transition hover:border-sky-400 hover:bg-sky-50">
                                                Details
                                            </button>
                                            <button type="button"
                                                class="inline-flex items-center rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                                                Edit
                                            </button>
                                            <button type="button"
                                                class="inline-flex items-center rounded-xl bg-rose-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-rose-700">
                                                Delete
                                            </button>
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
                                            <h3 class="mt-4 text-lg font-semibold text-slate-900">No orders found</h3>
                                            <p class="mt-2 text-sm text-slate-500">
                                                Orders will appear here once customers complete checkout.
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
