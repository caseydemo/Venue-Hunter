@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="display-3">VENUE HUNTER</h1>
                <p class="lead">Give us a city. We'll give you numbers to start calling.</p>
                    

<form action="/" method="post" class="input">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
	        City: <input type="text" name="city">State: <input type="text" name="state">
	        <!-- <ul><strong>Keyword: <input type="text" name="keyword"><br></strong></ul> -->
	      
	        <!-- Split button -->
			<div class="btn-group">
			  <select name="keyword" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			    <li><option value="bar">Bar</option></li>
			    <li><option value="night_club">Night Club</option></li>
			    <li><option value="stadium">Stadium</option></li>
			  </select>
			</div>
			  <input type="submit">

	    </form>      



	<div class="jumbo-center">
	    @if(!empty($recent_city))
	    <h3>Recent Searches</h3>
		<table class="table table-striped">
		  <tr>
		    <th>City</th>
		    <th>Keyword</th> 
		    <th>Searched At</th>
		  </tr>
		  @for($i=0; $i<$search_count-1; $i++)
		  	<tr>
			    <td>{{ $recent_city[$i] }}</td>
			    <td>{{ $recent_keyword[$i] }}</td>
			    <td>{{ $recent_search_timestamp[$i] }}</td>
			</tr>
			@endfor
		</table>
	    @endif
	</div>
</body>
@endsection