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

   <a href="/"><button class="btn btn-alert">Back to search</button></a>

   <a href="/display"><button class="btn btn-xs btn-default">Back</button></a>
	
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
        <ul><strong>Hours: 
        @for($i=0; $i<7; $i++)
            <p>{{ $hours[$i] }}</p>
        @endfor

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
