@extends('layouts.admin')

@section('title', 'Users')

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
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin Panel</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Users overview</h1>
                        <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                            Review registered users and their account status in one place.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Total users</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $userRecords->count() }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Verified emails</p>
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
                        <h2 class="text-lg font-semibold text-slate-900">User table</h2>
                        <p class="text-sm text-slate-500">All user records currently stored in the database.</p>
                    </div>
                    <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                        {{ $userRecords->count() }} records
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Created</th>
                                <th class="px-6 py-4 text-right">Actions</th>
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
                                    <td class="px-6 py-4 text-sm text-slate-700">{{ $user->role?->name ?? 'No role' }}</td>
                                    <td class="px-6 py-4">
                                        @if ($user->email_verified_at)
                                            <span
                                                class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                Verified
                                            </span>
                                        @else
                                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $user->created_at?->format('M d, Y') ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
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
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-md">
                                            <div
                                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                                                0
                                            </div>
                                            <h3 class="mt-4 text-lg font-semibold text-slate-900">No users found</h3>
                                            <p class="mt-2 text-sm text-slate-500">
                                                User records will appear here once accounts exist in the database.
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