<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Basic_func extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->helper('url');
              ini_set('gd.jpeg_ignore_warning', 1);
	}
public function distance($lat1,$log1,$lat2,$log2,$max_dis){
       
       $theta = $log1 - $log2;
       $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
       $dist = acos($dist);
       $dist = rad2deg($dist);
       $miles = $dist * 60 * 1.1515;
       
      return $miles;
    }
function getaddress($lat, $lon){
   $url  = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCpV8T0EqsVmdWkBw4_ep4y2xCmPFk6YSM&latlng=".$lat.",".$lon."&sensor=false";

 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
$result = curl_exec($ch);
curl_close($ch);
$data = json_decode($result);
return $data->results[0]->formatted_address;   
}

public function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
	// Calculate the distance in degrees
$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

	// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
	switch($unit) {
		case 'km':
	$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
		break;
		case 'mi':
	$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
			break;
		case 'nmi':
	$distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
	}
	return round($distance, $decimals);
}
}