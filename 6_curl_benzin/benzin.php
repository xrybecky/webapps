
<?php    
	$urltopost = "http://www.benzin.sk/index.php?";
	

	$town = 'price_search_town='.$obec;
	$region = 'price_search_region=-1';
	$brand = 'price_search_brand=-1';
	$fuel = 'price_search_fuel='.$fuel_name;
	$day = 'price_search_day=7';
	$tail = 'selected_id=118&article_id=-1';
	
	
	$url = "http://www.benzin.sk/index.php?price_search_town=$obec&price_submit=Vyh%BEada%9D&price_search_region=-1&price_search_brand=-1&price_search_fuel=$fuel_name&price_search_day=7&selected_id=118&article_id=-1";
	$urltopost .= $town.'&price_submit=Vyhľadať&'.$region.'&'.$brand.'&'.$fuel.'&'.$day.'&'.$tail;
	$ch = curl_init ($urltopost);	

	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	
	$returndata = curl_exec ($ch);

	$dom = new DOMDocument;
	$dom->loadHTML($returndata);
	$table = $dom->getElementById('article_text')->childNodes->item(8);
	$rows = $table->getElementsByTagName('tr');
	
	$array;
	
	for($i=0;$i<$rows->length-1;$i++){	
		$row = $rows->item(($i+1));
		$tds = $row->childNodes;
		
		$station = $tds->item(1)->childNodes->item(0)->nodeValue;
		$place = $tds->item(3)->childNodes->item(0)->childNodes->item(0)->nodeValue;
		$street = $tds->item(3)->childNodes->item(0)->nodeValue;
		$street = str_replace($place, '', $street);
		$price = 'http://benzin.sk/'.$tds->item(5)->firstChild->firstChild->getAttribute('src');		
		$date = $tds->item(6)->firstChild->nodeValue;
		
		$array[$i] = array('station' => $station, 'place' => $place,'street' => $street,'price' => $price,'date' => $date);		
	}
	$json = json_encode($array);
?>