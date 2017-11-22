<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class GuzzleController extends Controller
{


	public function getInput(Request $request){
		
		return view('/places/input');
	}


	public function getGeocode(Request $request){
		
		// *** GEOCODE INPUT  ***
		if(null !== $request->input('city')){
			$city = $request->input('city');
		}
		else{
			$city='';
		}
		if(null !== $request->input('state')){
			$state = $request->input('state');
		}
		else{
			$state='';
		}
		if(null !== $request->input('address')){
			$address = $request->input('adress');
		}
		else{
			$address='';
		}
		if(null !== $request->input('zipcode')){
			$zipcode = $request->input('zipcode');
		}
		else{
			$zipcode='';
		}

		// *** GEOSEARCH API ***
		$key = 'AIzaSyBnXl0SKKGNSo0BxBjsDYfPA-hIDMPtIgk';
		$geoClient = new Client();
		$geoRes = $geoClient->get('https://maps.googleapis.com/maps/api/geocode/json?' . 
			'address=' . $address . ',+' . $city . ',+' . $state . ',+' . $zipcode . '&key=' . $key);

		$tempGeoJSON = $geoRes->getBody();

		$geoJSON = json_decode($tempGeoJSON, true);

		$lattitude = $geoJSON['results'][0]['geometry']['location']['lat'];
		$longitude = $geoJSON['results'][0]['geometry']['location']['lng'];

		$keyword = $request->input('keyword');



		// *** NEARBY SEARCH ***

		$nearbySearchJSON = $this->getNearbySearch($lattitude, $longitude, $keyword);

		$loopCount = count($nearbySearchJSON['results']);


	// *** FOR LOOP FOR LOOP FOR LOOP ***

		for($i=0; $i<$loopCount-1; $i++){
			
			if(null !== $nearbySearchJSON['results'][$i]['name']){
				$nameArray[$i] = $nearbySearchJSON['results'][$i]['name'];
			}
			else{
				$nameArray[$i]='';
			}
			
		// *** PHOTO FUNCTION ***

			if(!empty($nearbySearchJSON['results'][$i]['photos'])){
				$photo_ref_array[$i]=$nearbySearchJSON['results'][$i]['photos'][0]['photo_reference'];
			}
			else{
				$photoref_array[$i]=0;
			}
			if(!empty($nearbySearchJSON['results'][$i]['id'])){
				$idArray[$i] = $nearbySearchJSON['results'][$i]['id'];
			}
			else{
				$idArray[$i] = '';
			}
			if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lat'])){
				$location_lat_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lat'];
			}
			else{
				$location_lat_array[$i]='';
			}
			if(!empty($nearbySearchJSON['results'][$i]['geometry']['location']['lng'])){
				$location_lng_array[$i] = $nearbySearchJSON['results'][$i]['geometry']['location']['lng'];
			}
			else{
				$location_lng_array[$i]='';
			}
			if(!empty($nearbySearchJSON['results'][$i]['vicinity'])){
				$vicinityArray[$i] = $nearbySearchJSON['results'][$i]['vicinity'];
			}
			else{
				$vicinityArray[$i]='';
			}
			if(!empty($nearbySearchJSON['results'][$i]['place_id'])){
				$place_id_array[$i] = $nearbySearchJSON['results'][$i]['place_id'];
			}
			else{
				$place_id_array[$i]='';
			}
			if( ! empty( $nearbySearchJSON['results'][$i]['opening_hours'] ) && 
				$nearbySearchJSON['results'][$i]['opening_hours'] !== null 
			) {
				$open_now_array[$i] = $nearbySearchJSON['results'][$i]['opening_hours'];
				if($open_now_array[$i]){
					$open_now_array[$i]='Yes';
				}
				else{
					$open_now_array[$i]='No';
				}
			}
			else{
				$open_now_array[$i]='N/A';
			}



		}

		// dd($photo_ref_array);



		$imageArray = $this->getPhoto($photo_ref_array);	

		// dd($photo_array);

	// *** END OF FOR LOOP END OF FOR LOOP END OF FOR LOOP ***

		return view('/places/display', compact(
					
					'loopCount', 
					'location_lat_array', 
					'location_lng_array', 
					'viewport_ne_lat', 
					'viewport_ne_lng', 
					'viewport_sw_lat', 
					'viewport_sw_lng', 
					'idArray', 
					'nameArray', 
					'open_now',
					'photo', 
					'indiv_photo_ref_array', 
					'place_id_array', 
					'rating', 
					'reference', 
					'scope', 
					'types', 
					'vicinityArray',
					'open_now_array',
					'jsonResponse'
					));
	}	

	public function getPhoto($photoref_array){
		$refCount = count($photoref_array);
		$imageArray=[];
		for($i=0; $i<$refCount-1; $i++){
			if(!empty($photoref_array[$i])){
				$key='AIzaSyBpgfAhYCQXyFHCLiCXu1hgVTltxH4o-a0';
				$client = new Client();
				$res = $client->get('https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $photoref_array[$i] . '&key=' . $key);
				$tempJson = $res->getBody();
				$jsonResponse = json_decode($tempJson, true);
			}
			else{
				$i++;
			}
		}
		dd($jsonResponse);
		return ($jsonResponse);
	}


	public function getDetailSearch($place_id){
		$detail_client = new Client();
		$hours=[];
		$res = $detail_client->get('https://maps.googleapis.com/maps/api/place/details/json?' 
			. 'placeid=' . $place_id . '&' 
			. 'key=AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM');
		
		$tempJson = $res->getBody();
		
		$jsonResponse = json_decode($tempJson, true);

		$loopCount = count($jsonResponse['result']);		
		
		$address = $jsonResponse['result']['formatted_address'];
		
		if(isset($jsonResponse['result']['formatted_phone_number'])){
			$phone_number = $jsonResponse['result']['formatted_phone_number'];
		}
		else{
			$phone_number = 'N/A';
		}
		
		$icon=$jsonResponse['result']['icon'];
		
		$name=$jsonResponse['result']['name'];
		

		if(isset($jsonResponse['result']['opening_hours'])){
			// Store hours
			for($i=0; $i<7; $i++){
				$hours[$i]=$jsonResponse['result']['opening_hours']['weekday_text'][$i]; 
				$open_now=$jsonResponse['result']['opening_hours']['open_now'];
			}
		}

		// REVIEWS
		$review_count=(count($author_name=$jsonResponse['result']['reviews'][0]));
		$author_name=$jsonResponse['result']['reviews'][0]['author_name'];
		$rating=$jsonResponse['result']['reviews'][0]['rating'];
		$time_description=$jsonResponse['result']['reviews'][0]['relative_time_description'];
		$review_text=$jsonResponse['result']['reviews'][0]['text'];

		// Review ARRAY
		for($i=0; $i<$review_count; $i++){

			if(isset($jsonResponse['result']['reviews'][$i]['author_name'])){
				$author_name_array[$i]=$jsonResponse['result']['reviews'][$i]['author_name'];
			}
			else{
				$author_name_array[$i]='';
			}
			if(isset($jsonResponse['result']['reviews'][$i]['rating'])){
				$rating_array[$i]=$jsonResponse['result']['reviews'][$i]['rating'];
			}
			else{
				$rating_array[$i]='';
			}
			if(isset($jsonResponse['result']['reviews'][$i]['relative_time_description'])){
				$time_description_array[$i]=$jsonResponse['result']['reviews'][$i]['relative_time_description'];
			}
			else{
				$time_description_array[$i]='';
			}
			if(isset($jsonResponse['result']['reviews'][$i]['text'])){
				$review_text_array[$i]=$jsonResponse['result']['reviews'][$i]['text'];
			}
			else{
				$review_text_array[$i]='';
			}
		}

			if(isset($jsonResponse['result']['url'])){
				$website=$jsonResponse['result']['url'];
			}
			else{
				$website='';
			}


		$map_url=$jsonResponse['result']['url'];


		return view('/places/detail', compact(
			'name', 
			'address', 
			'phone_number', 
			'open_now', 
			'hours',
			'map_url', 
			'website', 
			'icon', 
			'author_name_array', 
			'rating_array', 
			'time_description_array', 
			'review_text_array',
			'review_count'
		));
	}





	public function getNearbySearch($lattitude, $longitude, $keyword){

		// variable dictionary
		


		$nearbyClient = new Client();
		$lat = round($lattitude, 4);
		$long = round($longitude, 4);
		$radius = 5000;
		$type = 'night_club';
		
		if(empty($keyword)){
			$keyword = 'bar';
		}
		// $keyword = 'bar';
		$key = 'AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM';
		
		// api call with options
		$res = $nearbyClient->get('https://maps.googleapis.com/maps/api/place/nearbysearch/json?' 
			. 'location=' . $lat . ',' . $long . '&' 
			. 'radius=' . $radius . '&' 
			. 'type=' . $type . '&' 
			. 'keyword=' . $keyword . '&' 
			. 'key=' . $key);

		$tempJson = $res->getBody();
		$jsonResponse = json_decode($tempJson, true);

	
		// dd(count($jsonResponse));

		$counter = count($jsonResponse);

		for($i=0; $i<$counter; $i++){
			

			if( ! empty( $jsonResponse['results'][$i]['photos'][0]['html_attributions'][0] ) && 
						$jsonResponse['results'][$i]['photos'][0]['html_attributions'][0] !== null 
					) {

						$photo[$i] = $jsonResponse['results'][$i]['photos'][0]['html_attributions'][0];
			}
			else{
						$photo[$i]='https://www.hasslefreeclipart.com/clipart_compusers/images/error.gif';
					}

		}
		
		// dd($photo_array);



		return ($jsonResponse);
	}

	
}
