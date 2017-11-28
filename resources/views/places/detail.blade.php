@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<body>

   

<button class="btn btn-alert" onclick="history.go(-1);">Back to Search</button>


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
        <ul><a href="{{ $map_url }}" target="_blank"><button class="btn btn-lg hvr-bounce-to-right">{{$name}} on google maps</button></a></ul>

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
       
        @if($review_bool)
            <ul><h2>Reviews:</h2></ul>
            <hr>
            @for($i=0; $i<3; $i++)
                <ul><h3>{{$i+1}}. By:{{ $author_name_array[$i] }}, {{ $time_description_array[$i]}}</h3></ul>
                <ul><h4>{{ $rating_array[$i] }} Stars</h4></ul>
                <ul>{{ $review_text_array[$i] }}</ul>
                <hr>
                <br>
            @endfor
            </strong></ul>
            <hr>
        @endif
        </div>
    </div>

		
	
</body>
@endsection
