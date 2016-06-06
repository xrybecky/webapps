<?php
	require('config.php');
	if(isset($_SERVER['REMOTE_ADDR'])){	
		$uip_addr = $_SERVER['REMOTE_ADDR'];
		$json_ip_info = file_get_contents('http://ip-api.com/json/'.$uip_addr);
		$json_ip_info = json_decode($json_ip_info);
		$lon = $json_ip_info->lon;
		$lat = $json_ip_info->lat;
		$place;
		$country;
		$country_code = strtolower($json_ip_info->countryCode);
		$flag = 'http://www.geonames.org/flags/x/'.$country_code.'.gif';
		
		$g_api_key = 'AIzaSyA3CQMzhQ8DbMYkqQuOp46pArD7RMApH-I';
		$json_city_by_gmaps = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lon.'&key='.$g_api_key);
		$json_city_by_gmaps = json_decode($json_city_by_gmaps);
		//var_dump($json_city_by_gmaps);
		$localized = false;				
		foreach($json_city_by_gmaps->results as $result){
			if(sizeof($result->types) == 2){
				if($result->types[0] == "locality" && $result->types[1] == "political"){	
					// town, country
					$place_country = explode(',',$result->formatted_address);
					$place = trim($place_country[0], ' ');
					$country = trim($place_country[sizeof($place_country)-1], ' ');
					$localized = true;
				}
			}
			
			if(!($localized)){
				$place = "*Nepodarilo sa lokalizovať";
				$country = "Nelokalizované";
			}
		}
		
		$timestamp = time();
		$json_timezone = file_get_contents('https://maps.googleapis.com/maps/api/timezone/json?location='.$lat.','.$lon.'&timestamp='.$timestamp.'&key='.$g_api_key);
		$json_timezone = json_decode($json_timezone);
		$timestamp += ($json_timezone->rawOffset + $json_timezone->dstOffset);
		$user_time = gmdate('Y-m-d H:i:s', $timestamp);
		$user_time_to_db = gmdate('Y-m-d H:i:s', $timestamp);
		$dt_user_time = new DateTime($user_time);
		
		$query_select_by_ip = "SELECT MAX(datetime) as date, page FROM statistics WHERE ip='$uip_addr' AND page='$page_index'";
		$result_select_by_ip = $mysqli->query($query_select_by_ip)->fetch_array(MYSQLI_ASSOC);
		$result_select_by_ip_date = $result_select_by_ip['date'];			
		$result_select_by_ip_page = $result_select_by_ip['page'];			
		
		$datetime = new DateTime($result_select_by_ip_date);
		$interval = date_diff($datetime,$dt_user_time);
		
		if($interval->d > 0 || $result_select_by_ip_date == null){
			$query_insert_access = "INSERT INTO statistics (`id_ip`, `page`, `ip`, `country`, `country_icon`, `city`, `lon`, `lat`, `datetime`) 
							VALUES (NULL, '$page_index', '$uip_addr', '$country', '$flag', '$place', '$lon', '$lat','$user_time_to_db')";
			$mysqli->query($query_insert_access);
		}else if($interval->d == 0){
			if($result_select_by_ip_page != $page_index){
				$query_insert_access = "INSERT INTO statistics (`id_ip`, `page`, `ip`, `country`, `country_icon`, `city`, `lon`, `lat`, `datetime`) 
							VALUES (NULL, '$page_index', '$uip_addr', '$country', '$flag', '$place', '$lon', '$lat','$user_time_to_db')";
				$mysqli->query($query_insert_access);
			}
		}
	}
?>