<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Twitter;


class TwitterController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


    public function getTwitterHandle(){


        $keyword1 = 'lexington';
        $keyword2 = ', ky';
        $q=$keyword1 . $keyword2;



        return Twitter::getUsersSearch(['q' => $q, 'count' => 20, 'format' => 'json']);
    }
    public function getGeo(){
        $name = 'crossings';

        return Twitter::getGeoSimilar(['name' => $name, 'lat' => '38.0467441', 'long' => '-84.4966575', 'count' => 20, 'format' => 'json']);
    }
    public function getUserLookup(){
        return Twitter::getUsersLookup(['screen_name' => 'crossingsoflex', 'count' => 20, 'format' => 'json']);
    }

}

// crossings: lat: 38.0467441 long: -84.4966575

// 'q' => '38.0406', 