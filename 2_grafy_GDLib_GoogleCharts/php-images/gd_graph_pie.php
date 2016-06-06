<?php include('values.php');
putenv('GDFONTPATH=' . realpath('.'));

$font = '../fonts/OpenSans-Regular.ttf';


$graph_image = imagecreatetruecolor(1000,400);

$array_colors = array($graph_color_total = imagecolorallocate($graph_image, 52, 0,222),
						$graph_color_A = imagecolorallocate($graph_image, 233,0,0),
						$graph_color_B = imagecolorallocate($graph_image, 255,162,0),
						$graph_color_C = imagecolorallocate($graph_image, 0,160,5),
						$graph_color_D = imagecolorallocate($graph_image, 130,0,180),
						$graph_color_E = imagecolorallocate($graph_image, 100,250,255),
						$graph_color_FX = imagecolorallocate($graph_image, 215,0,157),
						$graph_color_FN = imagecolorallocate($graph_image, 200,240,0),
						$graph_color_black = imagecolorallocate($graph_image, 0,0,0),
						$graph_color_white = imagecolorallocate($graph_image, 255,255,255));	 

$color_fill = imagecolorallocate($graph_image, 66,133,244);						
imagefill($graph_image, 0, 0, $color_fill);

imagettftext($graph_image,12,0,40,380,$graph_color_black,$font,"Štatistika výsledkov študentov z predmetu Webové aplikácie v akademických rokoch 2012/13 - 2014/15");


$x_label = 0;
$y_label = 0;

for($j=0;$j<count($graph_data);$j++){
	imagettftext($graph_image,12,0,125+($j*320),320,$graph_color_black,$font,$graph_data[$j]['year']);
	$start_pie = 0;
	$sx = 150+($j*320);
	$sy = 150;
	$x_label = $sx+110;
	$y_label = $sy;
	
	for($i_result=1;$i_result<count($graph_data[$j]['result']);$i_result++){
		
		$percent = $graph_data[$j]['result'][$i_result]/$graph_data[$j]['result'][0];
		$end_pie = $start_pie + (($percent)*360);
		$radians = deg2rad($end_pie-$start_pie);
		if($end_pie != $start_pie){
			imagefilledarc($graph_image, 150+($j*320),150,200,200,$start_pie,$end_pie,$array_colors[$i_result],IMG_ARC_PIE);
			
			$new_x_label = (($x_label - $sx)*cos($radians/2) - ($y_label - $sy)*sin($radians/2))+$sx;
			$new_y_label = (($x_label - $sx)*sin($radians/2) + ($y_label - $sy)*cos($radians/2))+$sy;
	
			imagettftext($graph_image,10,0,$new_x_label,$new_y_label,$graph_color_black,$font,$values[$i_result].'='.round($percent*100,1).'%');
			
			$new_x_label = (($x_label - $sx)*cos($radians) - ($y_label - $sy)*sin($radians))+$sx;
			$new_y_label = (($x_label - $sx)*sin($radians) + ($y_label - $sy)*cos($radians))+$sy;
			$start_pie = $end_pie;
			$x_label = $new_x_label;
			$y_label = $new_y_label;
		}
	}
}

header("Content-type: image/png");
imagepng($graph_image);
imagedestroy($graph_image);
?>