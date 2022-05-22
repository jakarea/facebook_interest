<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Keyword;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function searchuser(Request $request)
    {
        
        $data = Keyword::where([
            'keyword' => $request->keyword,
            'language' => $request->language,
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
                'language' => $request->language,
                'user_id' => Auth::user()->id,
            ]);
        }

        $recents = Keyword::orderBy('id', 'desc')->where([
            'user_id' => Auth::user()->id
        ])->take(5)->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully',
                'recents' => $recents
            ]
        );
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
