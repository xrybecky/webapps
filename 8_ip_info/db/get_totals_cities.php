<?php
	if(isset($_GET['co'])){
		$get = $_GET['co'];
		require('../config.php');
		//SELECT DISTINCT city FROM statistics WHERE country='Czech Republic'
		$query_countries = "SELECT DISTINCT city FROM statistics WHERE country='$get'";
		$cities_result = $mysqli->query($query_countries);	
		
		$total_counts = array();
		while($row = $cities_result->fetch_array(MYSQLI_ASSOC)){		
			$city = $row['city'];
			$query_count_by_city = "SELECT SUM(c) as counts FROM (SELECT COUNT(DISTINCT ip) as c FROM statistics WHERE city='$city') as totals";
			$count = $mysqli->query($query_count_by_city)->fetch_array(MYSQLI_ASSOC)['counts'];
			$total_counts[] = array('name'=>$city, 'count'=>$count);
		}
	}
	echo json_encode($total_counts);
?>