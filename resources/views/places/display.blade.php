@extends('layouts.app-panel')

@section('title')
Let's Find a Venue

@endsection

@section('content')
    <body>

    <div class="outer-well">
        <div class="well detail-title-well">
            <h2 class="medium-title">{{ $cityName }}</h2>
            <h3 style="font-weight:bold">{{ $searchDate }}</h3>
            <form class="form-horizontal" method="post" action="/places">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <input type="hidden" name="city" value="{{ $cityName }}"> 
                    <input type="hidden" name="keyword" value="{{ $keyword }}"> 
                    <input type="hidden" name="lattitude" value="{{ $lattitude }}">
                    <input type="hidden" name="longitude" value="{{ $longitude }}">
                    <input type="hidden" name="searchDate" value="{{$searchDate}}">
                    @if(!$empty_search)
                        <p><button type="submit" name="button" value="save" class="btn-lg saveme hvr-pulse">Save Search</button></p>
                    @endif
                    @if($empty_search)
                         <div class="search-error"> Sorry - your search returned no results. </div>
                        <div class="clippy">
                            <img src="{{ asset('clippy_animation.gif') }}">
                        </div>
                         <a style="margin:auto;" href="/input"><button style="border-radius: 50%; width: 150px; height: 150px;" class=" btn-lg hvr-grow block-button">Try another search</button></a>
                    @endif
                </form>
            
        </div>
    </div>





        <div class="flex-center position-ref full-height">
           
        @if($loopCount>0)
   
                <div class="row">
                    @for($i=0; $i<$loopCount-1; $i++)
                   
                   <a href="/detail/{{$place_id_array[$i]}}">
                    <div class="hvr-wobble-vertical col-md-6 well well-lg">
                        <h2 style="font-weight: bold;">{{ $nameArray[$i] }}  </h2>
                        <div class="display-list">{{ $vicinityArray[$i] }}</div>
                        <div class="display-list">Open Now: {{ $open_now_array[$i] }}</div>       
                    </div>
                    </a>
                
                    @endfor
                    </div>
          </div>
          @endif
    </body>
@endsection

<!-- REFERENCE -->
