@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="medium-title">WHERE DO YOU WANT TO LOOK?</h1>

<form action="/" method="post" class="input form-inline">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <div class="form-group">
			  	<p class="input-label">City: </p>
			    <input type="text" name="city" class="form-control" id="city" placeholder="City">
			  </div>
			
			  	<p class="input-label">State: </p>
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
	</div>
</div>
	
</body>
@endsection