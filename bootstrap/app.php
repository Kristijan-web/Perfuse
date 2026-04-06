<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use \Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
        // ovde mogu i da hvatam svoje custom error-e i da im dodajem statusCode koji tip podatka vracu (JSON/XML, text,itd...) i mogu da uzmem prosledjenu poruku preko $e->getMessage(0)
        //
    
        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            return redirect()->route('login');
        });

        $exceptions->render(function (Throwable $err) {


            $errorCode = uuid_create();
            $errorLine = $err->getLine();
            $errorFile = $err->getFile();
            $errorMessage = $err->getMessage();


            $logEntry = $errorCode . " " . $errorMessage . " " . "in file:" . " " . $errorFile . " " . "at line:" . " " . $errorLine;

            Log::channel('custom')->error($logEntry);


            return redirect()->back()->withErrors(['errorCode' => $errorCode]);

        });




        // $exceptions->render(function (ModelNotFoundException $e, $request) {
        //     dd("UPAO U global handler u boostrap/app.php");
    
        //     if ($request->expectsJson()) {
        //         return response()->json([
        //             'message' => 'Resource not found',
        //         ], 404);
        //     }
    
        //     return response()->view('errors.404', [], 404);
        // });
    
    })->create();
