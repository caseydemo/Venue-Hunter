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
        $recent_searches = \App\Search::get();
        $search_count = count($recent_searches);

        for($i=0; $i<$search_count-1; $i++){

            if(!empty($recent_searches[$i]['attributes']['city'])){
                $recent_city[$i] = $recent_searches[$i]['attributes']['city'];
            }
            else{
                $recent_city[$i]='N/A';
            }
            if(!empty($recent_searches[$i]['attributes']['keyword'])){
                $recent_keyword[$i] = $recent_searches[$i]['attributes']['keyword'];
            }
            else{
                $recent_keyword[$i]='N/A';
            }
            if(!empty($recent_searches[$i]['attributes']['searched_at'])){
                $recent_search_timestamp[$i] = $recent_searches[$i]['attributes']['searched_at'];
            }
            else{
                $recent_search_timestamp[$i] = 'N/A';
            }

        }
        // dd($recent_city);
        // dd($recent_keyword);
        // dd($recent_search_timestamp);
        return view('places/input', compact('search_count', 'recent_city', 'recent_keyword', 'recent_search_timestamp'));
    }
}
