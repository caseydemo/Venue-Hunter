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

        <h4>Search Results for {{ $cityName }}</h4>
        <h4>{{ $searchDate }}</h4>

        	@for($i=0; $i<$loopCount-1; $i++)
        	<hr>
        		<ul><h1>Name: {{ $nameArray[$i] }}  </h1></ul>
                <ul><strong>Address: {{ $vicinityArray[$i] }}</strong></ul>
                <ul><strong>Open Now: {{ $open_now_array[$i] }}</strong></ul>        
                <ul><strong><a href="/detail/{{$place_id_array[$i]}}">Details</a></strong></ul>
                <hr>
        	@endfor


    </body>
@endsection

<!-- REFERENCE -->
