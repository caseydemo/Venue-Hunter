<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           
        $search = new \App\Search;
        $search->user_id=\Auth::user()->name;
        $search->city= $request->input('city');
        $search->keyword = $request->input('keyword');
        $search->lattitude = $request->input('lattitude');
        $search->longitude = $request->input('longitude');
        $search->searched_at = $request->input('searchDate');
        $search -> save();

        // dd($search->searched_at);
        return redirect('/saved');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $recent_searches = \App\Search::get();
        // $recent_city = $recent_searches[0]['attributes']['city'];
        // $recent_keyword = $recent_searches[0]['attributes']['keyword'];
        // $recent_search_timestamp = $recent_searches[0]['attributes']['keyword'];


        // return view('/places/input', compact('$recent_city', '$recent_keyword', '$recent_search_timestamp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
            $search = \App\Search::find($id);
            $search->delete();
            return redirect ('/saved');
    }


    public function getGeocode(Request $request){

        $empty_search=false;
        
        // *** GEOCODE INPUT  ***
        if(null !== $request->input('city')){
            $city = $request->input('city');
        }
        else{
            $city='';
        }
        if(null !== $request->input('state')){
            $state = $request->input('state');
        }
        else{
            $state='';
        }
        if(null !== $request->input('address')){
            $address = $request->input('adress');
        }
        else{
            $address='';
        }
        if(null !== $request->input('zipcode')){
            $zipcode = $request->input('zipcode');
        }
        else{
            $zipcode='';
        }

        // *** GEOSEARCH API ***
        $key = 'AIzaSyBnXl0SKKGNSo0BxBjsDYfPA-hIDMPtIgk';
        $geoClient = new Client();
        $geoRes = $geoClient->get('https://maps.googleapis.com/maps/api/geocode/json?' . 
            'address=' . $address . ',+' . $city . ',+' . $state . ',+' . $zipcode . '&key=' . $key);

        $tempGeoJSON = $geoRes->getBody();

        $geoJSON = json_decode($tempGeoJSON, true);
        // dd($geoJSON['results']);


        $lattitude = $geoJSON['results'][0]['geometry']['location']['lat'];
        $longitude = $geoJSON['results'][0]['geometry']['location']['lng'];

        $keyword = $request->input('keyword');

        $cityName = $geoJSON['results'][0]['formatted_address'];

        $searchDate = Carbon::now()->timezone('America/New_York')->toDayDateTimeString();

        // dd(Carbon::now()->timezone('America/New_York')->toDayDateTimeString());


        
        // *** NEARBY SEARCH ***

        $nearbySearchJSON = $this->getNearbySearch($lattitude, $longitude, $keyword);
        // dd($nearbySearchJSON);

        $loopCount = count($nearbySearchJSON['results']);

    // *** FOR LOOP FOR LOOP FOR LOOP ***

        for($i=0; $i<$loopCount-1; $i++){
            
            if(null !== $nearbySearchJSON['results'][$i]['name']){
                $nameArray[$i] = $nearbySearchJSON['results'][$i]['name'];
            }
            else{
                $nameArray[$i]='';
            }
            
            if(!empty($nearbySearchJSON['results'][$i]['id'])){
                $idArray[$i] = $nearbySearchJSON['results'][$i]['id'];
            }
            else{
                $idArray[$i] = '';
            }
            if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lat'])){
                $location_lat_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lat'];
            }
            else{
                $location_lat_array[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lng'])){
                $location_lng_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lng'];
            }
            else{
                $location_lng_array[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['vicinity'])){
                $vicinityArray[$i] = $nearbySearchJSON['results'][$i]['vicinity'];
            }
            else{
                $vicinityArray[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['place_id'])){
                $place_id_array[$i] = $nearbySearchJSON['results'][$i]['place_id'];
            }
            else{
                $place_id_array[$i]='';
            }
            if( ! empty( $nearbySearchJSON['results'][$i]['opening_hours'] ) && 
                $nearbySearchJSON['results'][$i]['opening_hours'] !== null 
            ) {
                $open_now_array[$i] = $nearbySearchJSON['results'][$i]['opening_hours'];
                if($open_now_array[$i]){
                    $open_now_array[$i]='Yes';
                }
                else{
                    $open_now_array[$i]='No';
                }
            }
            else{
                $open_now_array[$i]='N/A';
            }

        $recent_searches = \App\Search::get();
        
        }
    
        if(empty($recent_searches)){
            $empty_search=true;
        }
        else{
            $empty_search=false;
        }
        

    // *** END OF FOR LOOP END OF FOR LOOP END OF FOR LOOP ***

        return view('/places/display', compact(
                    
                    'empty_search',
                    'recent_search_timestamp',
                    'recent_keyword',
                    'recent_city',
                    'keyword',
                    'searchDate',
                    'cityName',
                    'lattitude',
                    'longitude',
                    'loopCount', 
                    'location_lat_array', 
                    'location_lng_array', 
                    'viewport_ne_lat', 
                    'viewport_ne_lng', 
                    'viewport_sw_lat', 
                    'viewport_sw_lng', 
                    'idArray', 
                    'nameArray', 
                    'open_now',
                    'photo', 
                    'indiv_photo_ref_array', 
                    'place_id_array', 
                    'rating', 
                    'reference', 
                    'scope', 
                    'types', 
                    'vicinityArray',
                    'open_now_array',
                    'jsonResponse'
                    ));
    }


    public function getDetailSearch($place_id){
        $detail_client = new Client();
        $hours=[];
        $review_bool=true;
        $res = $detail_client->get('https://maps.googleapis.com/maps/api/place/details/json?' 
            . 'placeid=' . $place_id . '&' 
            . 'key=AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM');
        
        $tempJson = $res->getBody();
        
        $detailJSON = json_decode($tempJson, true);

        $place_id=$detailJSON['result']['place_id'];

        $loopCount = count($detailJSON['result']);      

        if(isset($detailJSON['result']['formatted_address'])){
            $address = $detailJSON['result']['formatted_address'];
        }
        else{
            $address='';
        }       
        if(isset($detailJSON['result']['formatted_phone_number'])){
            $phone = $detailJSON['result']['formatted_phone_number'];
        }
        else{
            $phone = 'N/A';
        }
        
        $icon=$detailJSON['result']['icon'];
        
        $name=$detailJSON['result']['name'];

        
        if(!empty($detailJSON['result']['opening_hours'])){
            $open_now = $detailJSON['result']['opening_hours']['open_now'];
            for($i=0; $i<7; $i++){
                $hours[$i]=$detailJSON['result']['opening_hours']['weekday_text'][$i]; 
            }
        }
        else{
            for($i=0; $i<7; $i++){
                $hours[$i]='N/A'; 
            }
            $open_now = false;
        }
        
        

        
        if(isset($detailJSON['result']['reviews'])){
            $review_count=(count($author_name=$detailJSON['result']['reviews'][0]));

            $author_name=$detailJSON['result']['reviews'][0]['author_name'];
            $rating=$detailJSON['result']['reviews'][0]['rating'];
            $time_description=$detailJSON['result']['reviews'][0]['relative_time_description'];
            $review_text=$detailJSON['result']['reviews'][0]['text'];

            // Review ARRAY
            for($i=0; $i<$review_count; $i++){

                if(isset($detailJSON['result']['reviews'][$i]['author_name'])){
                    $author_name_array[$i]=$detailJSON['result']['reviews'][$i]['author_name'];
                }
                else{
                    $author_name_array[$i]='';
                }
                if(isset($detailJSON['result']['reviews'][$i]['rating'])){
                    $rating_array[$i]=$detailJSON['result']['reviews'][$i]['rating'];
                }
                else{
                    $rating_array[$i]='';
                }
                if(isset($detailJSON['result']['reviews'][$i]['relative_time_description'])){
                    $time_description_array[$i]=$detailJSON['result']['reviews'][$i]['relative_time_description'];
                }
                else{
                    $time_description_array[$i]='';
                }
                if(isset($detailJSON['result']['reviews'][$i]['text'])){
                    $review_text_array[$i]=$detailJSON['result']['reviews'][$i]['text'];
                }
                else{
                    $review_text_array[$i]='';
                    $author_name_array[$i]='';
                    $rating_array[$i]='';
                    $time_description_array[$i]='';
                }
            }
            }
            else{
                $review_bool=false;
                
            }
            $lattitude = $detailJSON['result']['geometry']['location']['lat'];
            $longitude = $detailJSON['result']['geometry']['location']['lng'];
            // dd($detailJSON['result']['geometry']['location']);
            // get this information to the twitter app???

            if(isset($detailJSON['result']['website'])){
                $website=$detailJSON['result']['website'];
            }
            else{
                $website='#';
            }

            $place_id = $detailJSON['result']['place_id'];

        $map_url=$detailJSON['result']['url'];

        $url='//www.google.com/maps/embed/v1/place?q=place_id:' . $place_id . '&zoom=17&key=AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM';

        return view('/places/detail', compact(
            'place_id',
            'lattitude',
            'longitude',
            'url',
            'name', 
            'address', 
            'phone', 
            'open_now', 
            'hours',
            'map_url', 
            'website', 
            'icon',
            'review_bool', 
            'author_name_array', 
            'rating_array', 
            'time_description_array', 
            'review_text_array',
            'review_count'
        ));
    }

    public function getNearbySearch($lattitude, $longitude, $keyword){

        // variable dictionary
        


        $nearbyClient = new Client();
        $lat = round($lattitude, 4);
        $long = round($longitude, 4);
        $radius = 5000;
        $type = 'bar';
        
        if(empty($keyword)){
            $keyword = 'bar';
        }
        // $keyword = 'bar';
        $key = 'AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM';
        
        // api call with options
        $res = $nearbyClient->get('https://maps.googleapis.com/maps/api/place/nearbysearch/json?' 
            . 'location=' . $lat . ',' . $long . '&' 
            . 'radius=' . $radius . '&' 
            . 'type=' . $type . '&' 
            . 'keyword=' . $keyword . '&' 
            . 'key=' . $key);

        $tempJson = $res->getBody();
        $jsonResponse = json_decode($tempJson, true);

    

        $counter = count($jsonResponse);

        for($i=0; $i<$counter; $i++){
            

            if( ! empty( $jsonResponse['results'][$i]['photos'][0]['html_attributions'][0] ) && 
                        $jsonResponse['results'][$i]['photos'][0]['html_attributions'][0] !== null 
                    ) {

                        $photo[$i] = $jsonResponse['results'][$i]['photos'][0]['html_attributions'][0];
            }
            else{
                        $photo[$i]='https://www.hasslefreeclipart.com/clipart_compusers/images/error.gif';
                    }

        }
        



        return ($jsonResponse);
    }


    public function getRecentSearch(Request $request){

        $searchDate = $request->input('search-date');
        $cityName = $request->input('city-name');
        $keyword = $request->input('keyword');
        $lattitude = $request->input('lattitude');
        $longitude = $request->input('longitude');

        // *** NEARBY SEARCH ***

        $nearbySearchJSON = $this->getNearbySearch($lattitude, $longitude, $keyword);


        $loopCount = count($nearbySearchJSON['results']);

    // *** FOR LOOP FOR LOOP FOR LOOP ***

        for($i=0; $i<$loopCount-1; $i++){
            
            if(null !== $nearbySearchJSON['results'][$i]['name']){
                $nameArray[$i] = $nearbySearchJSON['results'][$i]['name'];
            }
            else{
                $nameArray[$i]='';
            }
            
            if(!empty($nearbySearchJSON['results'][$i]['id'])){
                $idArray[$i] = $nearbySearchJSON['results'][$i]['id'];
            }
            else{
                $idArray[$i] = '';
            }
            if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lat'])){
                $location_lat_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lat'];
            }
            else{
                $location_lat_array[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lng'])){
                $location_lng_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lng'];
            }
            else{
                $location_lng_array[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['vicinity'])){
                $vicinityArray[$i] = $nearbySearchJSON['results'][$i]['vicinity'];
            }
            else{
                $vicinityArray[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['place_id'])){
                $place_id_array[$i] = $nearbySearchJSON['results'][$i]['place_id'];
            }
            else{
                $place_id_array[$i]='';
            }
            if( ! empty( $nearbySearchJSON['results'][$i]['opening_hours'] ) && 
                $nearbySearchJSON['results'][$i]['opening_hours'] !== null 
            ) {
                $open_now_array[$i] = $nearbySearchJSON['results'][$i]['opening_hours'];
                if($open_now_array[$i]){
                    $open_now_array[$i]='Yes';
                }
                else{
                    $open_now_array[$i]='No';
                }
            }
            else{
                $open_now_array[$i]='N/A';
            }

        $recent_searches = \App\Search::get();

        }
        if(empty($recent_searches)){
            $empty_search=true;
        }
        else{
            $empty_search=false;
        }


    // *** END OF FOR LOOP END OF FOR LOOP END OF FOR LOOP ***

        return view('/places/display', compact(
                    
                    'empty_search',
                    'recent_search_timestamp',
                    'recent_keyword',
                    'recent_city',
                    'keyword',
                    'searchDate',
                    'cityName',
                    'lattitude',
                    'longitude',
                    'loopCount', 
                    'location_lat_array', 
                    'location_lng_array', 
                    'viewport_ne_lat', 
                    'viewport_ne_lng', 
                    'viewport_sw_lat', 
                    'viewport_sw_lng', 
                    'idArray', 
                    'nameArray', 
                    'open_now',
                    'photo', 
                    'indiv_photo_ref_array', 
                    'place_id_array', 
                    'rating', 
                    'reference', 
                    'scope', 
                    'types', 
                    'vicinityArray',
                    'open_now_array',
                    'jsonResponse'
                    ));
    }
    public function showSavedSearches(){

        $recent_searches = \App\Search::orderBy('id', 'desc')->get();
        $search_count = count($recent_searches)+1;

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
                $searched_at[$i]=$recent_searches[$i]['attributes']['searched_at'];
            }
            else{
                $searched_at[$i] = 'N/A';
            }

            if(!empty($recent_searches[$i]['attributes']['user_id'])){
                $user_id[$i] = $recent_searches[$i]['attributes']['user_id'];
            }
            else{
                $user_id[$i] = [];
            }
            
            $lattitude[$i]=$recent_searches[$i]['attributes']['lattitude'];
            $longitude[$i]=$recent_searches[$i]['attributes']['longitude'];
            $recent_search_id[$i]=$recent_searches[$i]['attributes']['id'];
            
            // dd($searched_at);
        }
        return view('places.saved', compact('recent_search_id', 'longitude', 'lattitude', 'user_id', 'search_count', 'recent_city', 'recent_keyword', 'searched_at'));
    }


    public function geolocateSearch(Request $request){


        $nearbyClient = new Client();
        $lat = round($request->input('lattitude'), 4);
        $long = round($request->input('longitude'), 4);
        $radius = 5000;
        $type = 'bar';
        
        if(empty($keyword)){
            $keyword = 'bar';
        }
        // $keyword = 'bar';
        $key = 'AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM';
        
        // api call with options
        $res = $nearbyClient->get('https://maps.googleapis.com/maps/api/place/nearbysearch/json?' 
            . 'location=' . $lat . ',' . $long . '&' 
            . 'radius=' . $radius . '&' 
            . 'type=' . $type . '&' 
            . 'keyword=' . $keyword . '&' 
            . 'key=' . $key);

        $tempJson = $res->getBody();
        $nearbySearchJSON = json_decode($tempJson, true);
     
        $lattitude = $lat;
        $longitude = $long;

        $loopCount = count($nearbySearchJSON['results']);

    // *** FOR LOOP FOR LOOP FOR LOOP ***

        for($i=0; $i<$loopCount-1; $i++){


            
            if(null !== $nearbySearchJSON['results'][$i]['name']){
                $nameArray[$i] = $nearbySearchJSON['results'][$i]['name'];
            }
            else{
                $nameArray[$i]='';
            }
            
            if(!empty($nearbySearchJSON['results'][$i]['id'])){
                $idArray[$i] = $nearbySearchJSON['results'][$i]['id'];
            }
            else{
                $idArray[$i] = '';
            }
            if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lat'])){
                $location_lat_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lat'];
            }
            else{
                $location_lat_array[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lng'])){
                $location_lng_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lng'];
            }
            else{
                $location_lng_array[$i]='';
            }
            if(!empty($nearbySearchJSON['results'][$i]['vicinity'])){
                $vicinityArray[$i] = $nearbySearchJSON['results'][$i]['vicinity'];
                
            }
            else{
                $vicinityArray[$i]='';

            }
            if(!empty($nearbySearchJSON['results'][$i]['place_id'])){
                $place_id_array[$i] = $nearbySearchJSON['results'][$i]['place_id'];
            }
            else{
                $place_id_array[$i]='';
            }
            if( ! empty( $nearbySearchJSON['results'][$i]['opening_hours'] ) && 
                $nearbySearchJSON['results'][$i]['opening_hours'] !== null 
            ) {
                $open_now_array[$i] = $nearbySearchJSON['results'][$i]['opening_hours'];
                if($open_now_array[$i]){
                    $open_now_array[$i]='Yes';
                }
                else{
                    $open_now_array[$i]='No';
                }
            }
            else{
                $open_now_array[$i]='N/A';
            }

        $recent_searches = \App\Search::get();
        
        }
    
        if(empty($recent_searches)){
            $empty_search=true;
        }
        else{
            $empty_search=false;
        }

        $cityName = explode(', ', $nearbySearchJSON['results'][0]['vicinity']);
        $cityName = 'Current Location : ' . $cityName[1];
        

        $searchDate = Carbon::now()->timezone('America/New_York')->toDayDateTimeString();
        

    // *** END OF FOR LOOP END OF FOR LOOP END OF FOR LOOP ***

        return view('/places/display', compact(
                    
                    'empty_search',
                    'recent_search_timestamp',
                    'recent_keyword',
                    'recent_city',
                    'keyword',
                    'searchDate',
                    'cityName',
                    'lattitude',
                    'longitude',
                    'loopCount', 
                    'location_lat_array', 
                    'location_lng_array', 
                    'viewport_ne_lat', 
                    'viewport_ne_lng', 
                    'viewport_sw_lat', 
                    'viewport_sw_lng', 
                    'idArray', 
                    'nameArray', 
                    'open_now',
                    'photo', 
                    'indiv_photo_ref_array', 
                    'place_id_array', 
                    'rating', 
                    'reference', 
                    'scope', 
                    'types', 
                    'vicinityArray',
                    'open_now_array',
                    'jsonResponse'
                    ));

        
    }

}
