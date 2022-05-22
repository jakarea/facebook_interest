<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function redirectToFacebook()
    {
        
        return Socialite::driver('facebook')->fields([
            'name', 'last_name', 'email', 'gender', 'birthday'
        ])->scopes([
            'email', 'user_birthday'
        ])->stateless()->redirect();
       
    }

    public function handleFacebookCallback()
    {
       
        $user = Socialite::driver('facebook')->fields([
            'name', 'last_name', 'email', 'gender', 'birthday'
        ])->scopes([
            'email', 'user_birthday'
        ])->stateless()->user();
        // echo "<pre>";
        // var_dump($user);
        // exit();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }

    protected function _registerOrLoginUser($data)
    {
        // return $data;
        $user = User::where('facebook_id', '=', $data->id)->first();
        if(!$user) {
            $user = new User();
            $user->facebook_id = $data->id;
            $user->name = $data->name;
            $user->email = $data->email ? $data->email : time().'jakarea@yopmail.com';
            $user->access_token = $data->token;
            $user->avatar = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }
}
