@extends('layouts.user')

@section('content')
    <main class="auth-shell">
        <div class="mx-auto flex min-h-[calc(100vh-4rem)] max-w-6xl items-center justify-center">
            <section class="auth-card">
                <aside class="auth-side flex flex-col justify-center overflow-hidden lg:order-1">
                    <div class="auth-side-glow"></div>

                    <div class="auth-side-content flex flex-col items-center">
                        <p class="auth-side-title">
                            Nemate nalog?
                        </p>
                        <p class="auth-side-copy">
                            Registrujte ga
                        </p>

                        <a href="#"
                            class="auth-side-link focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#101010]">
                            Registrujte se.
                        </a>
                    </div>
                </aside>

                <div class="auth-form-panel flex flex-col lg:order-2">
                    <div class="max-w-md">
                        <h1 class="auth-title">
                            Tvoj nalog
                        </h1>
                    </div>

                    <form method="POST" action="{{ route('loginAPI') }}" class="auth-form flex flex-1 flex-col">
                        @csrf
                        <div class="auth-fields">
                            <div>
                                <label class="auth-label" for="login-email">
                                    Email
                                </label>
                                <input class="auth-input" id="login-email" name="email" type="email" autocomplete="email"
                                    placeholder="Email">
                            </div>

                            <div>
                                <label class="auth-label" for="login-password">
                                    &Scaron;ifra
                                </label>
                                <input class="auth-input" id="login-password" name="password" type="password"
                                    autocomplete="current-password" placeholder="&Scaron;ifra">
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <label class="auth-checkbox-row" for="remember">
                                    <input class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                                        type="checkbox" id="remember" name="remember">
                                    <span>Zapamti me</span>
                                </label>

                                <a href="#" class="text-sm text-blue-600 transition hover:text-blue-700">
                                    Zaboravili ste &scaron;ifru?
                                </a>
                            </div>
                        </div>

                        <div class="auth-submit-wrap lg:mt-auto pt-5">
                            <button
                                class="auth-submit focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2"
                                type="submit">
                                Prijava
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection