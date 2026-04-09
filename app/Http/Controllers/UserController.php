<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //
        // logika za upisivanje novog usera
        // znaci podatke mora da kupim i da ih imam u $validated = $request->validated();   

        $validated = $request->validated();

        User::create(['name' => $validated['name'], 'email' => $validated['email'], 'password' => $validated['password']]);

        return redirect()->route('adminUsersPage');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $userData = $request->input();
        // uzasno je sto radim $request al nemam vremena
        $userId = $user->id;
        $user = User::find($userId);
        // treba da se update-uju podaci samo koji su izmenjeni, znaci filtiraj svaki input koji je razlicit od null
        foreach ($userData as $key => $value) {
            if (empty($value)) {
                unset($userData[$key]);
            }
        }
        // $request->input() je asocijativan niz
        $user->update($userData);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();

        return redirect()->back();
    }
}
