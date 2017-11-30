@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<!-- 
'user_id', 
'place_id', 
'business_name', 
'address', 
'phone', 
'website', 
'lattitude', 
'longitude', 
'saved_at' -->
<div class="flex-center position-ref full-height">
    <div class="jumbotron vertical-center">
		<table style="overflow-x:auto;" class="table table-bordered">
		<tr >
			<th class="table-headings">User</th>
			<th class="table-headings">Business Name</th>
			<th class="table-headings">Address</th>
			<th class="table-headings">Phone</th>
			<th class="table-headings">Website</th>
			<th class="table-headings">Saved At</th>
		</tr>
		@for($i=0; $i<$loop_count; $i++)
		<tr>
			<td width="10%">{{ $user_id[$i] }} </td>
			<td width="20%">{{ $business_name[$i] }} </td>
			<td width="20%">{{ $address[$i] }} </td>
			<td width="20%"><a href="tel:'{{ $phone[$i] }}'">{{ $phone[$i] }}</a>  </td>
			<td width="20%"><a href="{{ $website[$i] }}"><button class="btn hvr-bounce-to-right">{{ $business_name[$i]}}'s website</button></a> </td>
			<td width="20%">{{ $saved_at[$i] }} </td>
		</tr>
	
			
		@endfor
		</table>
	</div>
</div>
@endsection

<!-- 
	stuff this page is receiving
	user_id
	place_id
	business_name
	address
	phone
	website
	lattitude
	longitude
	saved_at
		 -->