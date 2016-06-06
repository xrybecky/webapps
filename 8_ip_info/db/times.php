<?php
	include('../config.php');
	
	$query_times_m = "SELECT SUM(c) as total FROM (SELECT COUNT(DISTINCT ip) as c FROM `statistics` WHERE TIME(datetime) >= '06:00' AND TIME(datetime) < '14:00' GROUP BY DATE(datetime)) as counts"; 
	$query_times_l = "SELECT SUM(c) as total FROM (SELECT COUNT(DISTINCT ip) as c FROM `statistics` WHERE TIME(datetime) >= '14:00' AND TIME(datetime) < '20:00' GROUP BY DATE(datetime)) as counts"; 
	$query_times_e = "SELECT SUM(c) as total FROM (SELECT COUNT(DISTINCT ip) as c FROM `statistics` WHERE TIME(datetime) >= '20:00' AND TIME(datetime) < '24:00' GROUP BY DATE(datetime)) as counts"; 
	$query_times_n = "SELECT SUM(c) as total FROM (SELECT COUNT(DISTINCT ip) as c FROM `statistics` WHERE TIME(datetime) >= '00:00' AND TIME(datetime) < '06:00' GROUP BY DATE(datetime)) as counts"; 
	
	$result_m = $mysqli->query($query_times_m)->fetch_array(MYSQLI_ASSOC)['total'];
	$result_l = $mysqli->query($query_times_l)->fetch_array(MYSQLI_ASSOC)['total'];
	$result_e = $mysqli->query($query_times_e)->fetch_array(MYSQLI_ASSOC)['total'];
	$result_n = $mysqli->query($query_times_n)->fetch_array(MYSQLI_ASSOC)['total'];
	
	$json = array('m' => $result_m,'l' => $result_l,'e' => $result_e,'n' => $result_n);
	echo json_encode($json);
?>