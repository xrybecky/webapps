<?php
	require('../config.php');
	
	$query_lat_lng = "SELECT DISTINCT city, lat, lon FROM statistics";
	$result = $mysqli->query($query_lat_lng);
	
	$json = array();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$json[] = array('city'=>$row['city'], 'lat'=>$row['lat'], 'lon'=>$row['lon']);
	}
	
	echo json_encode($json);
?>