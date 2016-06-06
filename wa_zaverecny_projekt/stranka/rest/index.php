<?php
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
	
	if(sizeof($request) > 1){
		$key = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		$begin = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		$end = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		$step = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		$func = $_GET['func'];
		
		$mysqli = new mysqli('localhost', 'root', '06834265', 'spolzadanie');
		$query_find_key = "SELECT * FROM apis WHERE api_key='$key'";
		$result = $mysqli->query($query_find_key);
		if($result->num_rows == 1){
			include('octave.php');
		}else{
			$error['api-key-error'] = "invalid API key";
			echo json_encode($error);
		}
		
	}else{
		http_response_code(404);
	}

?>
