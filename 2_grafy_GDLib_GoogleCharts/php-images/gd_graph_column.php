<?php include('values.php');
putenv('GDFONTPATH=' . realpath('.'));
$font = '../fonts/OpenSans-Regular.ttf';

$graph_image = imagecreatetruecolor(800,400);

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


imagettftext($graph_image,11,0,50,40,$graph_color_black,$font,"Štatistika výsledkov študentov z predmetu Webové aplikácie v akademických rokoch 2012/13 - 2014/15");

imageline($graph_image, 30,375,30,10,$graph_color_black);
imagettftext($graph_image,10,90,10,70,$graph_color_black,$font,"počet\r\nštudentov");

for($i=3;$i>=0;$i--){
	imageline($graph_image, 25,370-($i*80),770,370-($i*80),$graph_color_black);
	imagettftext($graph_image,12,0,5,375-($i*80),$graph_color_black,$font,$i*20);
	imagedashedline($graph_image, 25,330-($i*80),770,330-($i*80),$graph_color_black);
	imagettftext($graph_image,10,0,5,335-($i*80),$graph_color_black,$font,10+($i*20));
}
imagettftext($graph_image,10,0,730,390,$graph_color_black,$font,'ak. rok');

$column_tab = 1;
for($j=0;$j<count($graph_data);$j++){
	$color_index = 0;
	imagettftext($graph_image,12,0,110+($j*250),395,$graph_color_black,$font,$graph_data[$j]['year']);
	foreach($graph_data[$j]['result'] as $d){
		$color = imagecolorallocate($graph_image,$d*4,255,$d*4);
		imagefilledrectangle($graph_image, 40*$column_tab,370,40*$column_tab+20,370-($d*4),$array_colors[$color_index]);//80px = 20ludi
		
		imagettftext($graph_image,12,75,40*$column_tab+15,365-($d*4),$array_colors[$color_index],$font,$values[$color_index]);
		$color_index++;		
		$column_tab += 0.6;
	}
	$column_tab += 0.6*3;
}

header("Content-type: image/png");
imagepng($graph_image);
imagedestroy($graph_image);
?>