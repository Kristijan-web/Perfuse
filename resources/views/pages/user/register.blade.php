@extends('layouts.user')

@section('content')
    <main class="auth-shell">
        <div class="mx-auto flex min-h-[calc(100vh-4rem)] max-w-6xl items-center justify-center">
            <section class="auth-card">
                <div class="auth-form-panel flex flex-col">

                    <div class="max-w-md">
                        <h1 class="auth-title">
                            Napravite nalog
                        </h1>
                    </div>

                    <form method="POST" action="{{ route('registerAPI') }}" class="auth-form flex flex-1 flex-col">
                        @csrf

                        <div class="auth-fields">
                            <div>
                                <label class="auth-label" for="register-name">
                                    Ime
                                </label>
                                <input class="auth-input"  id="register-name" name="name" type="text" value="{{ old('name') }}"
                                    autocomplete="name" placeholder="Ime">
                                    @if($errors->has('name')) 
                                    <p class="text-red-500">* {{ $errors->first('name') }}</p>
                                    @endif
                            </div>

                            <div>
                                <label class="auth-label" for="register-email">
                                    Email
                                </label>
                                <input class="auth-input" id="register-email" name="email" type="email" autocomplete="email" value="{{ old('email') }}"
                                    placeholder="Email">

                                    @if ($errors->has('email'))

                                    <p class="text-red-500">* {{ $errors->first('email') }}</p>
                                        
                                    @endif
                            </div>

                            <div>
                                <label class="auth-label" for="register-password">
                                    &Scaron;ifra
                                </label>
                                <input class="auth-input" id="register-password" name="password" type="password" 
                                    autocomplete="new-password" placeholder="&Scaron;ifra">
                                    @if($errors->has('password')) 
                                        <p class="text-red-500">* {{ $errors->first('password') }} </p>
                                    @endif
                            </div>

                            <div>
                                <label class="auth-label" for="repeat-password">
                                    Potvrdi &scaron;ifru
                                </label>
                                <input class="auth-input" id="repeat-password" name="password_confirmation" type="password"
                                    autocomplete="new-password" placeholder="Potvrdi &scaron;ifru">
                            </div>

                            <label class="auth-checkbox-row" for="remember">
                                <input class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                                    type="checkbox" id="remember" name="remember">
                                <span>Zapamti me</span>
                            </label>
                        </div>

                            @if($errors->has('errorCode'))

                            <p class="text-red- ">Nesto nije u redu sa aplikacijom, molimo vas kontaktirajte nas na 111-222-333 i prosledite ovaj kod:{{ $errors->first('errorCode') }}</p>

                            @endif
                            
                        
                        
                        <div class="auth-submit-wrap lg:mt-auto pt-5">
                            <button
                                class="auth-submit focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2"
                                type="submit">
                                Registruj se
                            </button>




                        </div>

                    </form>

                </div>
                        {{-- @if($errors->any())
            <ul class="px-4 py-2 bg-red-100">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{$error}}</li>
                @endforeach
            </ul>
        @endif --}}

                <aside class="auth-side flex flex-col justify-center overflow-hidden">
                    <div class="auth-side-glow"></div>

                    <div class="auth-side-content flex flex-col items-center">
                        <p class="auth-side-title">
                            Ve&#263; imate nalog?
                        </p>
                        <p class="auth-side-copy">
                            Prijavite se da bi ste ostali povezani
                        </p>

                        <a href="#"
                            class="auth-side-link focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#101010]">
                            Prijava
                        </a>
                    </div>
                </aside>
            </section>
        </div>
    </main>
@endsection