<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        return view('pages.user.homePage.home');
    }

    public function shop()
    {
        return view('pages.user.shopPage.shop');
    }

    public function login()
    {

    }

    public function register()
    {

    }

}


// Zbog cega nisam napravio layout unathorized.blade.php?
// - Zato sto je ono sto ce videti authorizovan i neuthorizovan user biti isto samo ce se razlikovati sta ce smeti da vide
// - sturktura layouta ce ostati ista (staticki deo)

// Zbog cega sam napravio poseban layout admin.blade.php?
// - Zato sto ce se onaj staticki deo znatno menjati u odnosu na to da li je korisnik user ili admin
// - Struktura, ono cemu ce pristupiti admin ce se znatno razlikovati od strukture koju ce koristiti user