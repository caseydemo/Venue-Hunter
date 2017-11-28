@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<body>
     <div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="medium-title">{{ $name }}</h1>
                <p class="lead">{{ $address }}</p>
                <p class="lead">{{ $phone_number }}</p>

        <ul><strong>Open Now:
        @if($open_now) 
            Yes</strong></ul>
        @else
            No</strong></ul>
        @endif
        <ul><img src="{{ $icon }}"/></ul>
        @if($website!= '#')
            <ul><a href="{{ $website }}" target="_blank"><button class="btn btn-lg hvr-bounce-to-right">{{$name}}'s Website</button></a></ul>
        @else
            <ul>Website N/A</ul>
        @endif
        
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
