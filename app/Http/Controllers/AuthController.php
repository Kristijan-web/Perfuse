<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthController extends Controller
{
    // page controler vraca login i register stranice

    public function login($request)
    {

    }

    public function register(RegisterRequest $request)
    {

        // mora da napravim custom request za reigster i tu da radim validaciju

        try {

            $validated = $request->validated();

            User::create(['email' => $validated['email'], 'password' => $validated['password'], 'name' => $validated['name']]);

            return redirect()->route('homePage');


            // ako se desi greska treba da se upise u log fajl
            // ako je sve dobro vraca se redict na home page

        } catch (Throwable $err) {



            $stackTrace = $err->getTraceAsString();
            $errorCode = uuid_create();
            $message = $err->getMessage();

            $logEntry = $errorCode . " " . $message . " " . $stackTrace;

            Log::error($logEntry);

            return redirect()->back()->withErrors(['errorCode' => $errorCode]);


        }

    }
}
