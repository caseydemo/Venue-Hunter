@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<body>

<h1>Club Hunter!</h1>

<form action="/" method="post">
        <input style="text-align:center" type="hidden" name="_token" value="{{ csrf_token() }}">
        <ul><strong>City: <input type="text" name="city"><br></strong></ul>
        <ul><strong>State: <input type="text" name="state"><br></strong></ul>
        <ul><strong>Keyword: <input type="text" name="keyword"><br></strong></ul>
        <input type="submit">
    </form>


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
</body>
@endsection