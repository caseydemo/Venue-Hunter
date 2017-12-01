@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<div class="flex-center position-ref full-height">
            <div class="jumbotron input vertical-center">
                <h1 class="medium-title">WHERE DO YOU WANT TO LOOK?</h1>

<form action="/" method="post" class="input form-inline">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <div class="form-group">
			  	<p class="input-label">City: </p>
			    <input type="text" name="city" class="form-control" id="city" placeholder="City">
			  </div>
			
			  	
			  	<p class="input-label">Keyword: </p>
			<div class="btn-group">
				<select name="keyword" style="font-weight: bolder;" type="button hvr-float" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			    <li><option style="font-weight: bolder;" value="bar">Bar</option></li>
			    <li><option style="font-weight: bolder;" value="night_club">Night Club</option></li>
			    <li><option style="font-weight: bolder;" value="stadium">Stadium</option></li>
			  </select>
			</div>
			<button type="submit" style="font-weight: bolder; margin-left: 15px;" class="btn btn-default hvr-sweep-to-right">SEARCH</button>
	    </form> 

		  <body>
		  	<button onclick="getLatLng()">call this array</button>
		  	<!-- public function getNearbySearch($lattitude, $longitude, $keyword){ -->
		  	
		  	<div class="map-container">
		    	<div id="map"></div>
			</div>
			<div id="lat"></div>
			<div id="lng"></div>
			<script src="{{ asset('js/map.js') }}"></script>
			<script async defer
		    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM&callback=initMap">
		    </script>
		  </body>
		</html>
  	</div>
</div>
	
</body>
@endsection