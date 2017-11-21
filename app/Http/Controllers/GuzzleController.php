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
		$key = 'AIzaSyBnXl0SKKGNSo0BxBjsDYfPA-hIDMPtIgk';
		$client = new Client();
		
		$res = $client->get('https://maps.googleapis.com/maps/api/geocode/json?' . 
			'address=' . $address . ',+' . $city . ',+' . $state . ',+' . $zipcode . '&key=' . $key);
		$tempJson = $res->getBody();
		$jsonResponse = json_decode($tempJson, true);
		$lattitude = $jsonResponse['results'][0]['geometry']['location']['lat'];
		$longitude = $jsonResponse['results'][0]['geometry']['location']['lng'];

		dd($jsonResponse);
		
		$jsonResponse = $this->getNearbySearch($lattitude, $longitude);

		$loopCount = count($jsonResponse['results']);
		
		$nameArray=[];
		$idArray=[];
		$location_lat1_array=[];
		$location_lng_array=[];
		$vicinityArray=[];
		$open_now_array=[];
		

		for($i=0; $i<$loopCount-1; $i++){
			$nameArray[$i] = $jsonResponse['results'][$i]['name'];
			$idArray[$i] = $jsonResponse['results'][$i]['id'];
			$location_lat_array[$i] = $jsonResponse['results'][$i]['geometry']['location']['lat'];
			$location_lng_array[$i] = $jsonResponse['results'][$i]['geometry']['location']['lng'];

			$vicinityArray[$i] = $jsonResponse['results'][$i]['vicinity'];
			$place_id_array[$i] = $jsonResponse['results'][$i]['place_id'];
			$open_now_array[$i]= $jsonResponse['results'][$i]['opening_hours']['open_now'];

		}



		// *** OPTIONS LIBRARY ***

		$viewport_ne_lat = $jsonResponse['results'][0]['geometry']['viewport']['northeast']['lat'];
		$viewport_ne_lng = $jsonResponse['results'][0]['geometry']['viewport']['northeast']['lng'];
		$viewport_sw_lat = $jsonResponse['results'][0]['geometry']['viewport']['southwest']['lat'];
		$viewport_sw_lng = $jsonResponse['results'][0]['geometry']['viewport']['southwest']['lng'];
		$open_now = $jsonResponse['results'][0]['opening_hours']['open_now'];
		// $photos = $jsonResponse['results'][0]['photos'];
		$indiv_photo = $jsonResponse['results'][0]['photos'][0];
		$indiv_photo_html_attrib = $jsonResponse['results'][0]['photos'][0]['html_attributions'][0];
		$indiv_photo_ref = $jsonResponse['results'][0]['photos'][0]['photo_reference'];
		$place_id = $jsonResponse['results'][0]['place_id'];


		$rating = $jsonResponse['results'][0]['rating'];
		$reference = $jsonResponse['results'][0]['reference'];
		$scope = $jsonResponse['results'][0]['scope'];
		$types = $jsonResponse['results'][0]['types'];

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
					'indiv_photo_html_attrib', 
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

	public function getDetailSearch($place_id){
		$client = new Client();
		$hours=[];
		
		
		$res = $client->get('https://maps.googleapis.com/maps/api/place/details/json?' 
			. 'placeid=' . $place_id . '&' 
			. 'key=AIzaSyDfFpdRXLxePuewXiw7SLYut0e3adZNymM');
		$tempJson = $res->getBody();
		$jsonResponse = json_decode($tempJson, true);
		$loopCount = count($jsonResponse['result']);

		$address = $jsonResponse['result']['formatted_address'];
		$phone_number = $jsonResponse['result']['formatted_phone_number'];
		$icon=$jsonResponse['result']['icon'];
		$name=$jsonResponse['result']['name'];
		

		// Store hours
		for($i=0; $i<7; $i++){
			$hours[$i]=$jsonResponse['result']['opening_hours']['weekday_text'][$i]; // array
		}
		$open_now=$jsonResponse['result']['opening_hours']['open_now'];
		
		
		
		// dd($jsonResponse['result']['photos']);

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



		$map_url=$jsonResponse['result']['url'];
		$website=$jsonResponse['result']['website'];


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





	public function getNearbySearch($lattitude, $longitude){

		// variable dictionary
		


		$nearbyClient = new Client();
		$lat = round($lattitude, 4);
		$long = round($longitude, 4);
		$radius = 5000;
		$type = 'restaurant';
		$keyword = 'bar';
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
		return ($jsonResponse);
	}

	
}
