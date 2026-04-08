@extends('layouts.admin')

@section('title', 'Create user')

@section('content')
    <section class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl space-y-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 px-6 py-8 text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-300">Admin Panel</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Create user</h1>
                <p class="mt-3 max-w-2xl text-sm text-slate-300 sm:text-base">
                    Add a new user account by filling out the details below.
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <form method="POST" action="{{ route('createUserAPI') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Enter full name" required>
                        @error('name')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Enter email address" required>
                        @error('email')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <input id="password" name="password" type="password"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Enter password" required>
                        @error('password')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ url('/admin/users') }}"
                            class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-100">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-400">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection