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
        $this->facebook = $facebook;
    }

    public function searchuser(Request $request)
    {

        $search_data = null;

        if (isset($_GET['keyword'])) {

            if (!Auth::check())
                return redirect()->back()->with('error', 'Please login first with your facebook!');

            if($request->keyword == null)
                return redirect()->back()->with('error', 'Please enter a keyword');

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

            $api_url = 'https://graph.facebook.com/search?type=adinterest&q=' . $request->keyword . '&limit=10000&locale=' . $request->language . '&access_token=' . Auth::user()->access_token;
            $search_data = Http::get($api_url);

            $audience_size_modified = [];
            foreach ($search_data['data'] as $data) {

                $data['audience_size_lower_bound'] = $this->makeAudienceToKilloandMillion($data['audience_size_lower_bound']);
                $data['audience_size_upper_bound'] = $this->makeAudienceToKilloandMillion($data['audience_size_upper_bound']);
                $audience_size_modified[] = $data;
            }
            $search_data = $audience_size_modified;
        }
        $recents = [];
        if (Auth::user())
            $recents = Keyword::orderBy('updated_at', 'desc')->where([
                'user_id' => Auth::user()->id
            ])->take(5)->get();

        $login_url = $this->facebook->facebookConnect();
        return view('welcome', compact('search_data', 'login_url', 'recents'));
    }
    
    public function makeAudienceToKilloandMillion($audienceNumber)
    {
        if ($audienceNumber > 999 && $audienceNumber <= 999999) {
            $result = round(($audienceNumber / 1000), 2) . ' K';
        } elseif ($audienceNumber > 999999) {
            $result = round(($audienceNumber / 1000000), 2) . ' M';
        } else {
            $result = $audienceNumber;
        }
        return $result;
    }
}
