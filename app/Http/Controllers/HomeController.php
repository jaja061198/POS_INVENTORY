<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function artisancall()
    {

        \Artisan::call('view:clear');

        \Artisan::call('config:clear');

        \Artisan::call('config:cache');

        \Artisan::call('clear-compiled');

    }
}
