<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        }

       return view('places.contacts', compact('loop_count', 'user_id', 'place_id', 'business_name', 'address', 'phone', 'website', 'lattitude', 'longitude', 'saved_at'));
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

        return redirect('/');    
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
        //
    }
}
