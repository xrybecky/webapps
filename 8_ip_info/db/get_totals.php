<?php
	require('../config.php');
	
	$query_countries = "SELECT DISTINCT country, country_icon FROM statistics";
	$countries_result = $mysqli->query($query_countries);	
	
	$total_counts = array();
	while($row = $countries_result->fetch_array(MYSQLI_ASSOC)){		
		$country = $row['country'];
		$query_count_by_country = "SELECT SUM(c) as total FROM (SELECT COUNT(DISTINCT ip) as c FROM statistics WHERE country='$country' GROUP BY DATE(datetime)) as counts";
		$count = $mysqli->query($query_count_by_country)->fetch_array(MYSQLI_ASSOC)['total'];
		$total_counts[] = array('name'=>$country, 'flag'=>$row['country_icon'], 'count'=>$count);
	}
	
	echo json_encode($total_counts);
?>