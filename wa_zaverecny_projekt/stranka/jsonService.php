<?php	
	
header('Content-Type: text/html; charset=utf-8');
require_once 'includes/jsonRPCServer.php';
include 'apikey.php';


class example {

	private $someData = array (
							'name' => 'Some Proper Name',
							'attr' => 'Some Personal Attribute'
							);
	

	private function reserved($min,$max) {
		return rand($min,$max);
	}
	


	public function getCoordinates($begin,$end,$func,$key){

		$step = 0.1;
		$filecontents = file_get_contents('keys.txt');
		$keys = preg_split('/[\s]+/', $filecontents, -1, PREG_SPLIT_NO_EMPTY);
		$toContinue = 0;
		foreach($keys as $keyA){
			if($key == $keyA){
				$toContinue = 1;
			}
		}
		if($toContinue == 1){
			$file_name = 'files/' . date('Y-m-d-H:i:s') . '.m';
			
			$script = fopen($file_name, 'w') or die("Unable to open file!");
			$txt = 'x=' . $begin . ':' . $step . ':' . $end . ';';
			$txt .= 'y=' . $func . ';';
			$txt .= 'yd=' . 'diff(' . $func . ');';
			$txt .= 'A=[x, y, yd];';
			$txt .= 'disp(num2str(A));';
			fwrite($script, $txt);
			fclose($file_name);
			
			$result = shell_exec('octave -q ' . $file_name);
			$result = preg_replace('/\s+/', ' ',$result);
			$result = explode(' ', $result);
			$json = array_chunk($result, sizeof($result)/3);
			$final_json['x'] = $json[0];
			$final_json['y'] = $json[1];
			$final_json['y_diff'] = $json[2];

			return json_encode($final_json,JSON_UNESCAPED_UNICODE);
		}
	}
}

$myExample = new example();
jsonRPCServer::handle($myExample)
	or print 'no request';
?>