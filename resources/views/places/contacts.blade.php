@extends('layouts.app-panel')

@section('title')
Contacts Page
@endsection

@section('content')

<div class="flex-center position-ref full-height">
    <div class="jumbotron vertical-center">
    	<h1 class="medium-title">{{ \Auth::user()->name }}'s Saved Contacts</h1>
   		<table style="overflow-x:auto;" class="table">
		<thead >
			<th class="table-headings">Business Name</th>
			<th class="table-headings">Address</th>
			<th class="table-headings">Phone</th>
			<th class="table-headings">Website</th>
			<th class="table-headings">Saved At</th>
		</thead>>
		@for($i=0; $i<$loop_count; $i++)
		<tr>
			<td><strong><a href="/show-contacts/{{$place_id[$i]}}"><button style="font-weight:bold;" class="btn hvr-wobble-vertical" >{{ $business_name[$i] }}</button></a></strong></td>
			<td>{{ $address[$i] }} </td>
			<td width="20%" ><a href="tel:'{{ $phone[$i] }}'">{{ $phone[$i] }}</a>  </td>
			<td><a href="{{ $website[$i] }}"><button class="btn hvr-bounce-to-right">Website</button></a> </td>
			<td>{{ $saved_at[$i] }} </td>
		</tr>
	
			
		@endfor
		</table>
	</div>
</div>
<div class="spacer">

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