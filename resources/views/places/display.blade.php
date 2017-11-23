@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
    <body>
        <a href="/"><button class="btn btn-alert">Back to search</button></a>

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
