@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
<a href="/home"><button class="btn btn-alert">Back to search</button></a>

@endsection

@section('content')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="medium-title">{{ $cityName }}</h1>
                <h3 style="font-weight:bold">{{ $searchDate }}</h3>
                 <form class="form-horizontal" method="post" action="/places">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <input type="hidden" name="city" value="{{ $cityName }}"> 
                    <input type="hidden" name="keyword" value="{{ $keyword }}"> 
                    <input type="hidden" name="lattitude" value="{{ $lattitude }}">
                    <input type="hidden" name="longitude" value="{{ $longitude }}">
                    <input type="hidden" name="searchDate" value="{{$searchDate}}">
                     <p><button type="submit" name="button" value="save" class="btn-lg hvr-pulse">Save Search</button></p>
                </form>
            </div>
        </div>    
            <div class="jumbotron vertical-center">
                   
                    
                    @for($i=0; $i<$loopCount-1; $i++)
                    <hr>
                        <ul><h3>{{ $nameArray[$i] }}  </h3></ul>
                        <ul><strong>{{ $vicinityArray[$i] }}</strong></ul>
                        <ul><strong>Open Now: {{ $open_now_array[$i] }}</strong></ul>        
                        <ul><strong><a href="/detail/{{$place_id_array[$i]}}"><button style="font-weight:bold;" class="btn hvr-wobble-vertical" >Details</button></a></strong></ul>
                        <hr>
                    @endfor
            </div>
    </body>
@endsection

<!-- REFERENCE -->
