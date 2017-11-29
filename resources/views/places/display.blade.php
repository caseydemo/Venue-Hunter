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
                <p><button class="btn-lg hvr-pulse" onclick="window.print()">Print Results</button></p>
                 <form class="form-horizontal" method="post" action="/places">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <input type="hidden" name="city" value="{{ $cityName }}"> 
                    <input type="hidden" name="keyword" value="{{ $keyword }}"> 
                    <input type="hidden" name="lattitude" value="{{ $lattitude }}">
                    <input type="hidden" name="longitude" value="{{ $longitude }}">
                    <input type="hidden" name="searchDate" value="{{$searchDate}}">
                    @if(!$empty_search)
                        <p><button type="submit" name="button" value="save" class="btn-lg hvr-pulse">Save Search</button></p>
                    @endif
                    @if($empty_search)
                         <p class="search-error"> Sorry - your search returned no results. </p>
                        <div class="clippy">
                            <img src="{{ asset('clippy_animation.gif') }}">
                            <a href="/input"><button class="btn btn-lg">Try another search</button></a>
                        </div>
                    @endif
                </form>
            </div>
        </div>    
        @if($loopCount>0)
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
          @endif
    </body>
@endsection

<!-- REFERENCE -->
