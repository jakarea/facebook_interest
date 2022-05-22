<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\FacebookController;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    protected $facebook;

    public function __construct(FacebookController $facebook)
    {
        $this->facebook = $facebook;
    }

    public function welcome(){
        $login_url = $this->facebook->facebookConnect();
        return view('welcome',compact('login_url'));
    }
}
