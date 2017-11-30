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
     <div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="medium-title">{{ $name }}</h1>
                <p class="lead">{{ $address }}</p>
                <p class="lead"><a href="tel:'{{ $phone }}'">{{ $phone }}</a> </p>

        <ul><strong>Open Now:
        @if($open_now) 
            Yes</strong></ul>
        @else
            No</strong></ul>
        @endif
        <ul><img src="{{ $icon }}"/></ul>
        @if($website!= '#')
            <ul>
            <a href="{{ $website }}" target="_blank"><button class="btn-lg hvr-pulse">{{$name}}'s Website</button></a>

        @else
            <ul>Website N/A</ul>
        @endif
        <button type="submit" name="button" value="save" form="detail" class="btn-lg hvr-pulse">Add to Contacts</button>
            <button class="btn-lg hvr-pulse" onclick="window.print()">Print Results</button>
        </ul>
        
        @if($hours[0]!='N/A')
            <ul><strong>Hours:</ul></strong> 
            @for($i=0; $i<7; $i++)
                <p>{{ $hours[$i] }}</p>
            @endfor
        @endif
        </strong>

        <!-- IFRAME -->
        <iframe class="iframe" src="{{$url}}">
        </iframe>
       
        @if($review_bool)
            <ul><h2>Reviews:</h2></ul>
            <hr>
            @for($i=0; $i<3; $i++)
                <ul><h3>{{$i+1}}. By:{{ $author_name_array[$i] }}, {{ $time_description_array[$i]}}</h3></ul>
                <div class="review-body">
                    <ul>{{ $rating_array[$i] }} Stars</ul>
                    <ul>{{ $review_text_array[$i] }}</ul>
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
