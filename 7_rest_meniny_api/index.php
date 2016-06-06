<?php
	$trans = array('á'=>'a','ä'=>'a', 'č' => 'c', 'ç' => 'c', 'ď'=>'d', 'é'=>'e', 'ě'=>'e','ë'=>'e', 'í'=>'i', 'ľ'=>'l', 'ĺ'=>'l', 'ň'=>'n', 'ó'=>'o', 'ö'=>'o', 'ř'=>'r','š'=>'s', 'ť'=>'t','ú'=>'u','ů'=>'u', 'ü'=>'u', 'ý'=>'y', 'ž'=>'z');

	$xml = new DOMDocument();
	$xml->loadXML(file_get_contents('meniny.xml'));
	$xml_content = $xml->documentElement;			
	$days = $xml_content->getElementsByTagName('zaznam');

	// get the HTTP method, path and body of the request
	$method = $_SERVER['REQUEST_METHOD'];

	//trim($str, 'znak'); -> odstrani znak z retazca ak sa nachdza znak na zaciatku alebo na konci retazca
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
	 
	if(sizeof($request) > 1){
		$countryCode = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		$countryCode = strtoupper($countryCode);
		$service = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		
		switch($service){
			
			case 'meniny':
					$element = strtoupper($countryCode);
					$dayId = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
					if(isset($_GET['q'])){
						$query = $_GET['q'];
						$decQuery = strtr(strtolower($query),$trans);
					}					
				break;
				
			case 'sviatky': 
					$element = $countryCode.$service;
				break; 
				
			case 'dni':  
					$element = $countryCode.$service;
				break;
				
			default: http_response_code(404);
		}	
	}else{
		http_response_code(404);
	}

	switch ($method) {
	  case 'GET':
	  
		if($days){
			if($decQuery){		
				$finded = false;
				foreach($days as $item){
					$tmp = $item->getElementsByTagName($element)->item(0)->nodeValue;
					$xpldNames = explode(',', $tmp);
					
					foreach($xpldNames as $name){
						$name = trim($name, ' ');
						$name = strtr(strtolower($name), $trans);
						if(strcmp($name, $decQuery) == 0){					
							$den = $item->getElementsByTagName('den')->item(0)->nodeValue;								
							$return = array();
							$return['den'] = convertDate($den);
							$return['meno'] = $item->getElementsByTagName($element)->item(0)->nodeValue;
							$finded = true;
							break;
						}						
					}
					if($finded){
						break;
					}
				}			
				echo json_encode($return);
				
			}else if($dayId){			
				foreach($days as $item){	
					$d = $item->getElementsByTagName('den')->item(0)->nodeValue;
					if(strcmp($d, $dayId) == 0){
						$meniny = $item->getElementsByTagName($element)->item(0)->nodeValue;
						$return = array();
						$return['den'] = convertDate($d);
						$return['meno'] = $meniny;	
						break;
					}
				}
				echo json_encode($return);
				
			}else{
				$array = array();
				$i = 0;
				foreach($days as $item){
					if($item->getElementsByTagName($element)->item(0)->nodeValue != null){
						$array[$i]['den'] = convertDate($item->getElementsByTagName('den')->item(0)->nodeValue);
						$array[$i]['title'] = $item->getElementsByTagName($element)->item(0)->nodeValue;
						$i++;
					}				
				}				
				$json = json_encode($array,JSON_UNESCAPED_UNICODE);
				echo $json;
			}
		}
		break;
		
	  case 'POST': 
		if($query && $dayId){
			// append $query TO <zaznam>-><$element>		
			foreach($days as $item){	
				$d = $item->getElementsByTagName('den')->item(0)->nodeValue;
				if(strcmp($d, $dayId) == 0){					
						$skd = $item->getElementsByTagName('SKd')->item(0)->nodeValue;
						$item->getElementsByTagName('SKd')->item(0)->nodeValue = $skd.', '.$query;	
						$xml->saveXML();							
						$xml->save('meniny.xml');		
						
						$return = array();
						$return['den'] = convertDate($d);
						$return['meno'] = $item->getElementsByTagName('SK')->item(0)->nodeValue;
						$return['other'] = $item->getElementsByTagName('SKd')->item(0)->nodeValue;
						
					break;
				}
			}
			echo json_encode($return);
		}else{
			echo json_encode(array('names'=>'Nesprávna požiadavka!'));
		}
		break;
	}

	function convertDate($date){
		$month = (int)substr($date,0,2);
		$day = (int)substr($date,2);
		return $day.'.'.$month.'.';
	}
?>
