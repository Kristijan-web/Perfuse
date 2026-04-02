<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        return view('pages.user.home');
    }

    public function shop()
    {
        return view('pages.user.shop');
    }

    public function login()
    {
        return view('pages.user.login');
    }

    public function register()
    {
        return view("pages.user.register");
    }

    public function cart()
    {
        return view('pages.user.cart');
    }

}


