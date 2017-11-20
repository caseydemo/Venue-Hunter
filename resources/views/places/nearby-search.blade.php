<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            ul {
                 list-style-type: none;
            }
       		 </style>
<body>

<!-- 	
	<ul><strong>Photo Reference: {{ $indiv_photo_ref }}</strong></ul>
	<ul><strong>viewport_ne_lat: {{ $viewport_ne_lat }}</strong></ul>
	<ul><strong>viewport_ne_lng: {{ $viewport_ne_lng }}</strong></ul>
	<ul><strong>viewport_sw_lat: {{ $viewport_sw_lat }}</strong></ul>
	<ul><strong>viewport_sw_lng: {{ $viewport_sw_lng }}</strong></ul>
	<ul><strong>Name: {{ $nameArray[0] }}  </strong></ul>
	<ul><strong>Open Now: {{ var_dump($open_now) }} </strong></ul> 
	<ul><strong>Rating: {{ $rating }} </strong></ul> 
	<ul><strong>Reference: {{ $reference }} </strong></ul> 
	<ul><strong>Scope: {{ $scope }}</strong></ul>
	@foreach($types as $type)
		<ul><strong>Type: {{ $type }}</strong></ul>
	@endforeach -->
	
    <a href="/"><button class="btn btn-alert">Back to search</button></a>

	@for($i=0; $i<$loopCount-1; $i++)
	<hr>
		<ul><h1>Name: {{ $nameArray[$i] }}  </h1></ul>
        <ul><strong>Address: {{ $vicinityArray[$i] }}</strong></ul>
        <ul><strong>Open Now:
        @if($open_now_array[$i]) 
            Yes</strong></ul>
        @else
            No</strong></ul>
        @endif

        <a href="/detail/{{$place_id_array[$i]}}">Details</a>

        <hr>
	@endfor
</body>
