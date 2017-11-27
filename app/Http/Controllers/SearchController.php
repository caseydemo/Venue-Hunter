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
        $search->searched_at = Carbon::now()->timezone('America/New_York')->toDayDateTimeString();
        // dd($search->city);
        $search -> save();

        return redirect('/home');    
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

        // dd($recent_city);

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
        //
    }


    public function getGeocode(Request $request){
        
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

        $lattitude = $geoJSON['results'][0]['geometry']['location']['lat'];
        $longitude = $geoJSON['results'][0]['geometry']['location']['lng'];

        $keyword = $request->input('keyword');

        $cityName = $geoJSON['results'][0]['formatted_address'];

        $searchDate = Carbon::now()->timezone('America/New_York')->toDayDateTimeString();

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
        $recent_city = $recent_searches[0]['attributes']['city'];
        // dd($recent_city);
        // $recent_keyword = $recent_searches[0]['attributes']['keyword'];
        // $recent_search_timestamp = $recent_searches[0]['attributes']['keyword'];

        }


    // *** END OF FOR LOOP END OF FOR LOOP END OF FOR LOOP ***

        return view('/places/display', compact(
                    
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

        $loopCount = count($detailJSON['result']);      
        
        if(isset($detailJSON['result']['formatted_address'])){
            $address = $detailJSON['result']['formatted_address'];
        }
        else{
            $address='';
        }       
        if(isset($detailJSON['result']['formatted_phone_number'])){
            $phone_number = $detailJSON['result']['formatted_phone_number'];
        }
        else{
            $phone_number = 'N/A';
        }
        
        $icon=$detailJSON['result']['icon'];
        
        $name=$detailJSON['result']['name'];

        for($i=0; $i<7; $i++){
            if( ! empty( $detailJSON['results'][$i]['opening_hours'] ) && $detailJSON['results'][$i]['opening_hours'] !== null){
                    $hours[$i]=$detailJSON['result']['opening_hours']['weekday_text'][$i]; 
            }
            else{
                $hours[$i]='N/A';
                $open_now='N/A';
            }
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

            if(isset($detailJSON['result']['url'])){
                $website=$detailJSON['result']['url'];
            }
            else{
                $website='';
            }


        $map_url=$detailJSON['result']['url'];


        return view('/places/detail', compact(
            'name', 
            'address', 
            'phone_number', 
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
        $type = 'night_club';
        
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

    
        // dd(count($jsonResponse));

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
        
        // dd($photo_array);



        return ($jsonResponse);
    }
}
