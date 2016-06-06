
<?php
	$urltopost = "http://pscpsc.sk/index.php";
	
		$obec = $psc;
		$urltopost .= '?input_txt_psc='.$psc;

		$ch = curl_init ($urltopost );

		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		
		$returndata = curl_exec ($ch);
		
		
		$dom = new DOMDocument;
		$dom->loadHTML($returndata);
		$table = $dom->getElementsByTagName('table')->item(0);
		
		$rows = $table->getElementsByTagName('tr')->item(1);
		if($rows == null){
			$obec = null;
		}else{
			foreach($rows->getElementsByTagName('td') as $cell){
				if(strcmp($cell->getAttribute('class'), 'tdobec') == 0){
					$obec = $cell->nodeValue;
				}
			}		
		}
		
?>