<?php	
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
	header("Connection: keep-alive");
	
	$begin = $_GET['begin'];
	$end = $_GET['end'];
	$step = $_GET['step'];
	$func = urldecode($_GET['func']);
	
	for($i=$begin; $i <= $end; $i += $step){
		$r = exec('maxima --batch-string="define(f(x), '.$func.'); define(g(x), diff(f(x),x)); [f('. number_format($i,2) .'), g('. number_format($i,2) .')];"');
		$r = extract_unit($r, '[', ']');
		$r = explode(',', $r);
		$json = null;
		$json['x'] = $i;
		$json['y'] = str_replace(' ', '', $r[0]);
		$json['yd'] = str_replace(' ', '', $r[1]);
		$json = json_encode($json);
		echo "data: {$json}\n\n";
		ob_flush();
		flush();
	}
	
	
	//$r = exec('maxima -q -r "f(5.0);"');
	/*
	for($i=$begin; $i < $end; $i += $step){
		
	}
	echo "data: {$result_by_group}\n\n";
	flush();*/
	
	function extract_unit($string, $start, $end){
		$pos = stripos($string, $start);
		$str = substr($string, $pos);		 
		$str_two = substr($str, strlen($start));		 
		$second_pos = stripos($str_two, $end);		 
		$str_three = substr($str_two, 0, $second_pos);		 
		$unit = trim($str_three); // remove whitespaces		 
		return $unit;
	}
?>