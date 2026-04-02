<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthController extends Controller
{
    // page controler vraca login i register stranice

    public function login(LoginRequest $request)
    {
        // Kako se radi login user-a?
        // - Dohvatam prosledjen email
        // - Nalazim user-a po email-u
        // - uzimam taj password i proveravam da li odgovarama hash-u prosledjnog password-a
        // - Ako je sve dobro upisujem user-ove podatke u sesiju i redirect-ujem ga na home page ili ukoliko je admin na admin panel
        // dd('upao');
        try {
            $validated = $request->validated();

            $email = $validated['email'];
            $password = Hash::make($validated['password']);

            $user = User::where('email', $email)->first();

            if (!$user) {

                return redirect()->back()->withErrors(['message' => 'Kredencijali neipsravni']);
            }

            if (Hash::check($password, $user->password)) {

                return redirect()->back()->withErrors(['message' => 'Kredencijali neipsravni']);

            }


            session()->put('user', $user);


            return redirect()->route('homePage');

        } catch (Throwable $err) {

            $errorCode = uuid_create();
            $errorLine = $err->getLine();
            $errorFile = $err->getFile();
            $errorMessage = $err->getMessage();


            $logEntry = $errorCode . " " . $errorMessage . " " . "in file:" . " " . $errorFile . " " . "at line:" . " " . $errorLine;

            Log::channel('custom')->error($logEntry);

        }


    }

    public function register(RegisterRequest $request)
    {

        // mora da napravim custom request za reigster i tu da radim validaciju


        try {

            $validated = $request->validated();

            User::create(['email' => $validated['email'], 'password' => $validated['password'], 'name' => $validated['name']]);

            return redirect()->route('loginPage');


        } catch (Throwable $err) {



            // $stackTrace = $err->getTraceAsString();
            $errorCode = uuid_create();
            $errorMessage = $err->getMessage();
            $errorLine = $err->getLine();
            $errorFile = $err->getFile();

            $logEntry = $errorCode . " " . $errorMessage . " " . "in file:" . " " . $errorFile . " " . "at line:" . " " . $errorLine;

            Log::channel('custom')->error($logEntry);

            return redirect()->back()->withErrors(['errorCode' => $errorCode]);


        }

    }
}
