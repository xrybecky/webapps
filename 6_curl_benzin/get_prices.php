<?php
	$json_array;
	if(isset($_POST['fuel_input']) && isset($_POST['psc_input'])){
		$psc = $_POST['psc_input'];
		$fuel_name = $_POST['fuel_input'];		
		
		include('psc.php');	
		if($obec != null){
			include('benzin.php');	
			if($json != 'null'){
				echo '<script> var j = '.$json.'; </script>';
			}else{
				echo '<script> var j = "Ľutujeme. Nenašli sa žiadne výsledky :("; </script>';
			}
		}else{
			echo '<script> var j = -1; </script>';
		}
	}
?>