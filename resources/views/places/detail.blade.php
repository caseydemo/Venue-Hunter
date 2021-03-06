@extends('layouts.app-panel')

@section('title')
Venue-Hunter
@endsection

@section('content')
<body>




<!-- reviewsModal -->
<div class="modal fade" id="reviewsModal" tabindex="-1" role="dialog" aria-labelledby="reviewsModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="reviewsModalLabel">Reviews</h4>
      </div>
      <div class="modal-body">
        @if($review_bool)
            
            @for($i=0; $i<3; $i++)
                <h3>{{$i+1}}. By:{{ $author_name_array[$i] }}, {{ $time_description_array[$i]}}</h3>
                <div class="review-body">
                    @for($j=0; $j<$rating_array[$i]; $j++)
                      <i class="fa fa-star" aria-hidden="true"></i>
                    @endfor
                    <p>{{$rating_array[$i]}} Stars</p>
                    <p>{{ $review_text_array[$i] }}</p>
               

                </div>
                <br>
            @endfor
           
            
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>


<!-- hoursModal -->
<div class="modal fade" id="hoursModal" tabindex="-1" role="dialog" aria-labelledby="hoursModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="hoursModalLabel">Opening Hours</h4>
      </div>
      <div class="modal-body">
         <h1 style="font-weight: bold;">Open Now:
        @if($open_now) 
            Yes <i class="fa fa-clock-o" aria-hidden="true"></i></h1>
        @else
            No</h1>
        @endif
        
        @if($hours[0]!='N/A')
            <ul><strong>Hours:</ul> 
            @for($i=0; $i<7; $i++)
                <p>{{ $hours[$i] }}</p>
            @endfor
        @endif
        </strong>      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   
      </div>
    </div>
  </div>
</div>


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
<div class="outer-well">
    <div class="top-left-button">
        @if($website!= '#')
            <a href="{{ $website }}" target="_blank"><button class="round-button btn-lg hvr-pulse">Visit their Site</button></a>
        @else
            <a href="#" target="_blank"><button class="round-button btn-lg hvr-pulse">Visit their Site</button></a>
         @endif
    </div>
        <div class="top-right-button">
            <button type="submit" name="button" value="save" form="detail" class="round-button btn-lg hvr-pulse">Add to Contacts</button>
        </div>
    <div class="well detail-title-well">
        <h1 class="detail-title">{{ $name }}</h1>
        <p class="lead">{{ $address }}</p>
        <p class="lead"><a href="tel:'{{ $phone }}'">Phone # {{ $phone }}</a> </p>
    </div>
</div>

     


        <div class="top-center-detail">        
                 <!-- IFRAME -->
            <iframe class="i-frame" src="{{$url}}">
            </iframe>
                    
            <div class="bottom-left-button">

                    <!-- Button trigger modal -->
                    <button type="button" class="round-button btn-lg hvr-pulse" data-toggle="modal" data-target="#hoursModal">
                      Hours
                    </button>
                
            </div>
            <div class="bottom-right-button">
                <!-- Button trigger modal -->
                <button type="button" class="round-button btn-lg hvr-pulse" data-toggle="modal" data-target="#reviewsModal">
                  Reviews
                </button>
            </div>
        </div>
        	
</body>
@endsection
