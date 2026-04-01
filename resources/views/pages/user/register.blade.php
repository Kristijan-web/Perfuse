@extends("layouts.user")

@section('content')
    <div
        class="w-full bg-white transition-all duration-400 ease-in-out md:absolute md:h-full md:w-1/2 md:right-1/2 md:translate-x-0 px-6 pt-8 pb-8 md:block md:p-10 md:pt-4">
        <div class="flex h-full flex-col">
            <h2 class="mb-4 text-xl font-bold text-gray-800 md:mb-6 md:text-2xl">
                Napravite nalog
            </h2>

            <form method="POST" action="" class="flex grow flex-col justify-center space-y-4 md:space-y-5">
                @csrf

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 md:mb-2" for="register-name">
                        Ime
                    </label>
                    <input
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                        id="register-name" name="name" type="text" autocomplete="username" placeholder="Ime">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 md:mb-2" for="register-email">
                        Email
                    </label>
                    <input
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                        id="register-email" name="email" type="email" autocomplete="email" placeholder="Email">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 md:mb-2" for="register-password">
                        Šifra
                    </label>
                    <input
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                        id="register-password" name="password" type="password" placeholder="Šifra"
                        autocomplete="current-password">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 md:mb-2" for="repeat-password">
                        Potvrdi šifru
                    </label>
                    <input
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                        id="repeat-password" name="confirm_password" type="password" placeholder="Potvrdi šifru"
                        autocomplete="password">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">
                        Zapamti me
                    </label>
                </div>

                <div class="mt-4 md:mt-auto">
                    <button class="btn w-full" type="submit">
                        Registruj se
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection