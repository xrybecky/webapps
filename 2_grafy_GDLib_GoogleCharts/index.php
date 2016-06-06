<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		
		<title>Zadanie 1</title>

		<?php
			
			$img_column = 'images/menu-column.png';
			$img_pie = 'images/menu-pie.png';
			$img_google = 'images/menu-google.png';
			$imgs = array($img_column, $img_pie, $img_google);
			
			$thumb_column = 'thumbs/thumb-menu-column.png';
			$thumb_pie = 'thumbs/thumb-menu-pie.png';
			$thumb_google = 'thumbs/thumb-menu-google.png';
			$thumbs = array($thumb_column, $thumb_pie, $thumb_google);
			
			$new_width = 180;
			$new_height = 180;
			
			for($i=0;$i<count($imgs);$i++){
				$img = imagecreatefrompng($imgs[$i]);
				$color_white = imagecolorallocate($img, 255,255,255);
				$tmp_img = imagecreatetruecolor($new_width, $new_height);
				
				$width = imagesx( $img );
				$height = imagesy( $img );
				imagefill($tmp_img, 0, 0, $color_white);
				imagecopyresized($tmp_img,$img, 0,0,0,0,$new_width, $new_height,$width, $height);
				imagepng($tmp_img, $thumbs[$i]);
			}			
		?>

		
	</head>
	<body>	
		<nav>
			<ul>
				<li><a href="column_chart.php"><img alt="Stĺpcový graf" src="thumbs/thumb-menu-column.png"></a></li>
				<li><a href="pie_chart.php"><img alt="Koláčový graf" src="thumbs/thumb-menu-pie.png"></a></li>
				<li><a href="google.php"><img alt="Google charts" src="thumbs/thumb-menu-google.png"></a></li>
			</ul>
		</nav>
		
	</body>
</html>