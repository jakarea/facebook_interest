<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\FacebookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public $facebook;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FacebookController $facebook)
    {
        $this->facebook = $facebook;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }


    /**
     * Logout of autheticated user
     * 
     */
    public function logout()
    {

        $this->facebook->facebookLogout(Auth::user()->access_token);

        Auth::logout();
        return redirect()->to('/');
    }
}
