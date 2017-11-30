<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contacts = \App\Contact::get();
        $loop_count = count($contacts);
        for($i=0; $i<$loop_count; $i++){
            $user_id[$i] = $contacts[$i]['attributes']['user_id'];
            $place_id[$i] = $contacts[$i]['attributes']['place_id'];
            $business_name[$i] = $contacts[$i]['attributes']['business_name'];
            $address[$i] = $contacts[$i]['attributes']['address'];
            $phone[$i] = $contacts[$i]['attributes']['phone'];
            $website[$i] = $contacts[$i]['attributes']['website'];
            $lattitude[$i] = $contacts[$i]['attributes']['lattitude'];
            $longitude[$i] = $contacts[$i]['attributes']['longitude'];
            $saved_at[$i] = $contacts[$i]['attributes']['saved_at'];
            $contact_id[$i]=$contacts[$i]['attributes']['id'];
        }

       return view('places.contacts', compact('contact_id', 'loop_count', 'user_id', 'place_id', 'business_name', 'address', 'phone', 'website', 'lattitude', 'longitude', 'saved_at'));
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
        $contact = new \App\Contact;

        $contact->user_id=\Auth::user()->name;
        $contact->place_id=$request->input('place_id');
        $contact->business_name= $request->input('business_name');
        $contact->address = $request->input('address');
        $contact->phone = $request->input('phone');
        $contact->website = $request->input('website');
        $contact->lattitude = $request->input('lattitude');
        $contact->longitude = $request->input('longitude');
        $contact->saved_at = Carbon::now()->timezone('America/New_York')->toDayDateTimeString();
        $contact -> save();

        return redirect('/contacts');    
           }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $contact = \App\Contact::find($id);
        $contact->delete();
        return redirect ('/contacts');
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
            $lattitude = $detailJSON['result']['geometry']['location']['lat'];
            $longitude = $detailJSON['result']['geometry']['location']['lng'];
            

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

}
