<?php
	require('../config.php');
	
	$query_1 = "SELECT page, COUNT(page) as c FROM statistics GROUP BY page ORDER BY c DESC LIMIT 1";
	$most_recent = $mysqli->query($query_1)->fetch_array(MYSQLI_ASSOC)['page'];
	echo $most_recent;
?>