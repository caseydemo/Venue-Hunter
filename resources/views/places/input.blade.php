@extends('layouts.app-panel')

@section('title')
Venue-Hunter
@endsection

@section('content')


<!-- Modal -->
<div class="modal fade" id="localSearchModal" tabindex="-1" role="dialog" aria-labelledby="localSearchModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	<h2 class="medium-title" style="text-align: center;" id="localSearchModalLabel">Venues close to you</h2>
      </div>
      <div class="modal-body" style="text-align: center;">
        <!-- if user's location is used -->
		<form action="/geolocate" method="post" class="input form-inline" id="local-search-form">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">	
	        <input type="hidden" name="lattitude" id="lattitude">
	        <input type="hidden" name="longitude" id="longitude">
	        <input type="hidden" name="keyword" value='bar' id="keyword">
	        
				
			  	<p class="input-label">Choose a Keyword: </p>
			<div class="btn-group">
				<select name="keyword" style="font-weight: bolder;" type="button hvr-float" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			    <li><option style="font-weight: bolder;" value="bar">Bar</option></li>
			    <li><option style="font-weight: bolder;" value="night_club">Night Club</option></li>
			    <li><option style="font-weight: bolder;" value="stadium">Stadium</option></li>
			  </select>
			</div>
			
	    </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" style="font-weight: bolder; margin-left: 15px;" class="btn btn-default hvr-sweep-to-right" form="local-search-form">SEARCH</button>
      </div>
    </div>
  </div>
</div>



<!-- REGULAR SEARCH -->
<!-- Modal -->
<div class="modal fade" id="regularSearchModal" tabindex="-1" role="dialog" aria-labelledby="regularSearchModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="/" method="post" class="input form-inline" id="regular-search-form">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  
			  	<p class="location input-label">City: </p>
			    <input type="text" name="city" class="form-control" id="city" placeholder="City">
			 
			  	<p class="location input-label">State: </p>
	        <select style="font-weight: bolder;" class="btn btn-default dropdown-toggle" name="state">
				<option value="AL">AL</option>
				<option value="AK">AK</option>
				<option value="AR">AR</option>	
				<option value="AZ">AZ</option>
				<option value="CA">CA</option>
				<option value="CO">CO</option>
				<option value="CT">CT</option>
				<option value="DC">DC</option>
				<option value="DE">DE</option>
				<option value="FL">FL</option>
				<option value="GA">GA</option>
				<option value="HI">HI</option>
				<option value="IA">IA</option>	
				<option value="ID">ID</option>
				<option value="IL">IL</option>
				<option value="IN">IN</option>
				<option value="KS">KS</option>
				<option value="KY">KY</option>
				<option value="LA">LA</option>
				<option value="MA">MA</option>
				<option value="MD">MD</option>
				<option value="ME">ME</option>
				<option value="MI">MI</option>
				<option value="MN">MN</option>
				<option value="MO">MO</option>	
				<option value="MS">MS</option>
				<option value="MT">MT</option>
				<option value="NC">NC</option>	
				<option value="NE">NE</option>
				<option value="NH">NH</option>
				<option value="NJ">NJ</option>
				<option value="NM">NM</option>			
				<option value="NV">NV</option>
				<option value="NY">NY</option>
				<option value="ND">ND</option>
				<option value="OH">OH</option>
				<option value="OK">OK</option>
				<option value="OR">OR</option>
				<option value="PA">PA</option>
				<option value="RI">RI</option>
				<option value="SC">SC</option>
				<option value="SD">SD</option>
				<option value="TN">TN</option>
				<option value="TX">TX</option>
				<option value="UT">UT</option>
				<option value="VT">VT</option>
				<option value="VA">VA</option>
				<option value="WA">WA</option>
				<option value="WI">WI</option>	
				<option value="WV">WV</option>
				<option value="WY">WY</option>
			</select>
		
				<br>
			  	<p class="keyword input-label">Keyword: </p>
			<div class="btn-group">
				<select name="keyword" style="font-weight: bolder;" type="button hvr-float" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			    <li><option style="font-weight: bolder;" value="bar">Bar</option></li>
			    <li><option style="font-weight: bolder;" value="night_club">Night Club</option></li>
			    <li><option style="font-weight: bolder;" value="stadium">Stadium</option></li>
			  </select>
			 </div>
			
	    </form> 
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" style="font-weight: bolder; margin-left: 15px;" class="btn btn-default hvr-sweep-to-right" form="regular-search-form">SEARCH</button>
		</div>
		</div>
	</div>
</div>


<div class="flex-center position-ref full-height">
            <div class="jumbotron input vertical-center">
                <h1 class="medium-title">WHERE DO YOU WANT TO LOOK?</h1>


<!-- Button trigger modal -->
<button type="button"   class="btn hvr-grow btn-lg big-left-button" data-toggle="modal" data-target="#regularSearchModal">
 Far Away?
</button>
<!-- Button trigger modal -->
<button type="button"  class="btn hvr-grow btn-lg big-right-button" data-toggle="modal" data-target="#localSearchModal">
 Near You?
</button>
		<div style="display: none;" class="map-container" id="map"></div>

		<script src="{{ asset('js/map.js') }}"></script>

            
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM&callback=initMap"></script>
			

		  </body>
		</html>
  	</div>
</div>
	
</body>
@endsection