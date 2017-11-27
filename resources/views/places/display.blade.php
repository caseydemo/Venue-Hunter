@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
<a href="/home"><button class="btn btn-alert">Back to search</button></a>

@endsection

@section('content')
    <form class="form-horizontal" method="post" action="/places">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <input type="hidden" name="city" value="{{ $cityName }}"> 
        <input type="hidden" name="keyword" value="{{ $keyword }}"> 
        <input type="hidden" name="lattitude" value="{{ $lattitude }}">
        <input type="hidden" name="longitude" value="{{ $longitude }}">
         <button type="submit" name="button" value="save" class="btn btn-md btn-default">Save Search</button>
    </form>


    <body>
        <div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="medium-title">HERE'S SOME NUMBERS.</h1>
                <p class="lead">Give us a city. We'll give you numbers to start calling.</p>

            </div>
        </div>


        
            <div class="jumbotron vertical-center">
                    <h2>Search Results for {{ $cityName }}</h2>
                    <h2>{{ $searchDate }}</h2>
                    @for($i=0; $i<$loopCount-1; $i++)
                    <hr>
                        <ul><h3>Name: {{ $nameArray[$i] }}  </h3></ul>
                        <ul><strong>Address: {{ $vicinityArray[$i] }}</strong></ul>
                        <ul><strong>Open Now: {{ $open_now_array[$i] }}</strong></ul>        
                        <ul><strong><a href="/detail/{{$place_id_array[$i]}}">Details</a></strong></ul>
                        <hr>
                    @endfor
            </div>
    </body>
@endsection

<!-- REFERENCE -->
