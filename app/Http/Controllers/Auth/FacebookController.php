<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Facebook\Facebook;
use Illuminate\Support\Facades\Http;
use App\User;


class FacebookController extends Controller
{
    protected $helper;
    protected $facebook;
    protected $oAuth2Client;

    /**
     * 
     * constructor method
     * 
     * @return Object of facebook SDK
     *
     */
    public function __construct()
    {
        // facebook credentials array
        $credentials = array(
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v13.0'
        );

        // create Object of Facebook SDK
        $this->facebook = new Facebook($credentials);
        // helper
        $this->helper = $this->facebook->getRedirectLoginHelper();
        //oAuth2Client
        $this->oAuth2Client = $this->facebook->getOAuth2Client();
    }

    /**
     * Show view page for login with facebook
     * 
     * @return \Illuminate\View\View
     */
    public function login()
    {
        $login_url = $this->facebookConnect();
        return view('auth.login', compact('login_url'));
    }

    /**
     * 
     * user can connect via fb account
     * 
     * @return String of facebook login url
     * 
     */
    public function facebookConnect()
    {
        //get permission from facebook
        $permissions = [
            'email',
            'public_profile'
        ];

        $facebook_login_url = $this->helper->getLoginUrl(env('FACEBOOK_REDIRECT_URI'), $permissions);
        return $facebook_login_url;
    }

    /**
     * 
     * an unique access_token will be generated who will connect with fb account
     * 
     * @return String
     * 
     */
    public function generateAccessToken()
    {
        if (request('state')) {
            $this->helper->getPersistentDataHandler()->set('state', request('state'));
        }

        if (isset($_GET['code'])) {
            try {
                $accessToken = $this->helper->getAccessToken();
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error ' . $e->getMessage;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error ' . $e->getMessage;
            }

            if (!$accessToken->isLongLived()) {
                try {
                    $accessToken = $this->oAuth2Client->getLongLivedAccessToken($accessToken);
                } catch (Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Error getting long lived access token ' . $e->getMessage();
                }
            }


            $access_token = (string) $accessToken;
            $user_permissions =  $this->checkUserPermission($access_token);
            foreach ($user_permissions['data'] as $permission) {
                if ($permission['permission'] == 'email' && $permission['status'] == 'granted') {
                    return $this->storeUser($access_token);
                } elseif ($permission['permission'] == 'email' && $permission['status'] == 'declined') {
                    return $this->facebookLogout($access_token);
                }
            }
        }
    }

    /**
     * Store user
     * 
     * @param String $access_token
     * 
     * @return \Illuminate\Http\Response
     */
    public function storeUser($access_token)
    {
        $feed_url = 'https://graph.facebook.com/me?fields=id,name,email&access_token=' . $access_token;
        $response =  Http::get($feed_url);

        $data = [];
        $data['facebook_id'] = $response['id'];
        $data['name'] = $response['name'];
        $data['email'] = $response['email'];
        $data['access_token'] = $access_token;
        $user = User::updateOrCreate(['email' => $response['email']], $data);

        return redirect('/')->with('success','Login Successfull');
    }

    /**
     * Get user permission list
     * 
     * @param String $access_token
     * 
     * @return Array
     */
    public function checkUserPermission($access_token)
    {
        $feed_url = 'https://graph.facebook.com/me/permissions?access_token=' . $access_token;
        $response =  Http::get($feed_url);
        return $response;
    }

    /**
     * Find user by access_token
     * 
     * @param String $access_token
     * 
     * @return Object
     */
    public function findUserByAccessToken($access_token)
    {
        $feed_url = 'https://graph.facebook.com/me?fields=id,name,email&access_token=' . $access_token;
        $user =  Http::get($feed_url);
        return $user;
    }

    /**
     * logout from facebook
     * 
     * @param String $access_token
     * 
     * @return Boolean
     */
    public function facebookLogout($access_token)
    {
        $user = $this->findUserByAccessToken($access_token);
        $feed_url = 'https://graph.facebook.com/' . $user['id'] . '/permissions?method=delete&access_token=' . $access_token;
        $response =  Http::delete($feed_url);
        return redirect()->route('facebook.login')->with('error','Please try to login with grent email access!');
    }
}
