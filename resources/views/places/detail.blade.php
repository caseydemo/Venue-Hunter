@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<body>


    <form class="form-horizontal" method="post" action="/contacts" id="detail">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <input type="hidden" name="business_name" value="{{ $name }}"> 
        <input type="hidden" name="place_id" value="{{ $place_id }}">
        <input type="hidden" name="address" value="{{ $address }}">
        <input type="hidden" name="phone" value="{{ $phone }}">
        <input type="hidden" name="website" value="{{ $website }}">
        <input type="hidden" name="lattitude" value="{{ $lattitude }}">
         <input type="hidden" name="longitude" value="{{ $longitude }}">
            
    </form>
    <div class="well detail-title-well">
        <h1 class="detail-title">{{ $name }}</h1>
        <p class="lead">{{ $address }}</p>
        <p class="lead"><a href="tel:'{{ $phone }}'">{{ $phone }}</a> </p>
       
    </div>

     


        <div class="top-center-detail">        
                 <!-- IFRAME -->
            <iframe class="i-frame" src="{{$url}}">
            </iframe>
                    
            <div class="web-div">
                @if($website!= '#')
                    
                    <a href="{{ $website }}" target="_blank"><button class="btn-lg hvr-pulse">{{$name}}'s Website</button></a>
                @endif
            </div>
            <div class="contact-div">
                <button type="submit" name="button" value="save" form="detail" class="btn-lg hvr-pulse">Add to Contacts</button>
            </div>
        </div>
        

<div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
        
        <strong><h2>Open Now:
        @if($open_now) 
            Yes <i class="fa fa-clock-o" aria-hidden="true"></i></h2></strong>
        @else
            No</h2>
        @endif
        
        @if($hours[0]!='N/A')
            <ul><strong>Hours:</ul></strong> 
            @for($i=0; $i<7; $i++)
                <p>{{ $hours[$i] }}</p>
            @endfor
        @endif
        </strong>
       
        @if($review_bool)
            <h2>Reviews:</h2>
            <hr>
            @for($i=0; $i<3; $i++)
                <h3>{{$i+1}}. By:{{ $author_name_array[$i] }}, {{ $time_description_array[$i]}}</h3>
                <div class="review-body">
                    @for($j=0; $j<$rating_array[$i]; $j++)
                      <i class="fa fa-star" aria-hidden="true"></i>
                    @endfor
                    <p>{{$rating_array[$i]}} Stars</p>
                    <p>{{ $review_text_array[$i] }}</p>
               

                </div>
                <hr>
                <br>
            @endfor
            </strong></ul>
            
        @endif
        </div>
    </div>

		
	
</body>
@endsection
