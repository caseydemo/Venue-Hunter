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
			  	<span style="display: inline-block;" class="label label-default">City: </span>
			    <input type="text" name="city" class="form-control" id="city" placeholder="City">
			  </div>
			
			  	<span style="display: inline-block;" class="label label-default">State: </span>
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
			  	<span style="display: inline-block;" class="label label-default">Keyword: </span>
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

@if(!empty(\Auth::user()->name))
	@for($i=0; $i<$search_count-1; $i++)
		<form action="/recent-search" method="post" class="input form-inline" id="{{$i}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <input type="hidden" name="lattitude" value="{{ $lattitude[$i] }}" >
	    <input type="hidden" name="longitude" value="{{ $longitude[$i] }}">
	    <input type="hidden" name="keyword" value="{{ $recent_keyword[$i]}} ">
	    <input type="hidden" name="city-name" value="{{ $recent_city[$i]}} ">
	    <input type="hidden" name="search-date" value="{{ $searched_at[$i] }}">
		</form>
	@endfor

	<div style="margin-top: 20px;" class="flex-center position-ref full-height">
    <div class="jumbotron vertical-center">
	<div class="jumbo-center">

	<h3>{{ \Auth::user()->name }}'s Recent Searches</h3>
	<table class="table table-striped">
		<tr>
		    <th>City</th>
		    <th>Keyword</th> 
		    <th>Searched At</th>
		    <th>Delete</th>
	  	</tr>
	@for($i=0; $i<$search_count-1; $i++)
		@if($user_id[$i]==\Auth::user()->name)		  
				  	<tr>
				  		<td><button type="submit" form="{{$i}}">{{ $recent_city[$i] }}</button></td>
					    <td>{{ $recent_keyword[$i] }}</td>
					    <td>{{ $searched_at[$i] }}</td>
					     <td>
						     <form class="button-form" method="post" action="/places/{{ $recent_search_id[$i] }}">
						     	{{ csrf_field() }}
	      						{{ method_field('DELETE') }}
	      						<button class="btn btn-xs btn-default">
	      						<i class="fa fa-trash" aria-hidden="true"></i>
	      						</button>
						     </form>
						 </td>
					</tr>
				@endif
		@endfor
		</table>
@endif
			</div>
		</div>
	</div>
</body>
@endsection