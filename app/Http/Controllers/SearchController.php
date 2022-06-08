<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\FacebookController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Keyword;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{


    public $facebook;
    public function __construct(FacebookController $facebook)
    {
        // $this->middleware('auth');
        $this->facebook = $facebook;
    }


    public function searchuser(Request $request)
    {


        $search_data = null;

        if (isset($_GET['keyword'])) {

            $data = Keyword::where([
                'keyword' => $request->keyword,
                'lang' => $request->language,
                'user_id' => Auth::user()->id,
            ])->first();

            if ($data) {
                Keyword::where([
                    'id' => $data->id,
                ])
                    ->update([
                        'hit' => $data->hit + 1
                    ]);
            } else {

                Keyword::create([
                    'keyword' => $request->keyword,
                    'lang' => $request->language,
                    'user_id' => Auth::user()->id,
                ]);
            }

            $recents = Keyword::orderBy('id', 'desc')->where([
                'user_id' => Auth::user()->id
            ])->take(5)->get();


            $api_url = 'https://graph.facebook.com/search?type=adinterest&q=' . $request->keyword . '&limit=10000&locale=' . $request->language . '&access_token=' . Auth::user()->access_token;
            $search_data = Http::get($api_url);
        }


        $login_url = $this->facebook->facebookConnect();
        return view('welcome', compact('search_data','login_url'));
    }

    public function ajaxRequestPost(Request $request)
    {

        DB::table('keywords')->insert([
            'Keyword' => $request->Keyword, //This Code coming from ajax request
            'user_id' => Auth::user()->id, //This Chief coming from ajax request
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
}
