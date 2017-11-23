@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<body>

   

<button class="btn btn-alert" onclick="history.go(-1);">Back to Search</button>

	<hr>
		<ul><h1>Name: {{ $name }}  </h1></ul>
        <ul><strong>Address: {{ $address }}</strong></ul>
        <ul><strong>Open Now:
        @if($open_now) 
            Yes</strong></ul>
        @else
            No</strong></ul>
        @endif
        <ul><img src="{{ $icon }}"/>Phone #: {{ $phone_number }}</ul>
        <ul><a href="{{ $map_url }}" target="_blank">{{$name}} on google maps</a></ul>
        <ul><a href="{{ $website }}" target="_blank">{{$name}}'s Website</a></ul>
        @if($hours=!null)
            <ul><strong>Hours:</ul></strong> 
            @for($i=0; $i<7; $i++)
                <p>{{ $hours[$i] }}</p>
            @endfor
        @else
            <ul><strong> N/A </ul></strong>
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
	
</body>
@endsection
