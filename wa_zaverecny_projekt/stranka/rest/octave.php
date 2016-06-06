<?php	
	$file_name = 'files/' . date('Y-m-d-H-i-s') . '.m';
	
	$script = fopen($file_name, 'w') or die("Unable to open file!");
	$txt = 'x=' . $begin . ':' . $step . ':' . $end . ';';
	$txt .= 'y=' . $func . ';';
	$txt .= 'yd=' . 'diff(' . $func . ');';
	$txt .= 'A=[x, y, yd];';
	$txt .= 'disp(num2str(A));';
	fwrite($script, $txt);
	fclose($file_name);
	
	$result = shell_exec('octave -q ' . $file_name);
	unlink($file_name);
	$result = preg_replace('/\s+/', ' ',$result);
	$result = explode(' ', $result);
	$json = array_chunk($result, sizeof($result)/3);
	$final_json['x'] = $json[0];
	$final_json['y'] = $json[1];
	$final_json['y_diff'] = $json[2];
	
	echo json_encode($final_json);
?>