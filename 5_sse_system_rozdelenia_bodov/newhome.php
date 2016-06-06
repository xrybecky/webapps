<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/dialog-style.css">
		
		
		<title>IV. Zadanie WA</title>
		
		<?php include("config.php");
			session_start();
			
			$merged_points = 0;
			$is_cpt = false;
			if(isset($_SESSION['user']) && isset($_SESSION['role']) && $_SESSION['role'] == 2){
				
				// USER INFO
				$login = $_SESSION['user'];
				$query_ids = "SELECT id_person AS uid, id_group AS g, points, status FROM osoby WHERE login='$login'";
				$result = $mysqli->query($query_ids)->fetch_array(MYSQL_ASSOC);
				$group_id = $result['g'];
				$uid = $result['uid'];
				$points = $result['points'];
				$status = $result['status'];
				echo "<p id=\"group\" hidden>".$group_id."</p>";
				echo "<p id=\"uid\" hidden>".$uid."</p>";
				
				// STUDENTS
				$query_students = "SELECT id_person, name, surname, points, status FROM osoby WHERE id_group='$group_id'";
				$students = $mysqli->query($query_students);
				
				$query_total_points = "SELECT points FROM hodnotenie WHERE  id_group='$group_id'";
				$total_points = $mysqli->query($query_total_points)->fetch_object()->points;
			}else{ 
				header("Location: index.php"); 
			}
		?>
		
		<script>
			var group = <?php echo $group_id; ?>;
			var showButtons = true;
		</script>
	</head>
	<body>
		
		<script src="sse/newsse.js" type="text/javascript"></script>
		
		<?php // VYBER KAPITANA
			$captain = "Nieje určený";
			$query_cpt_name = "SELECT o.id_person, o.name, o.surname FROM osoby AS o 
									JOIN hodnotenie AS h ON o.id_person=h.cpt WHERE h.id_group='$group_id'";
			$cpt_name = $mysqli->query($query_cpt_name)->fetch_array(MYSQL_ASSOC);
			
			if($cpt_name['id_person'] == null){
				echo "<div class=\"row\">";
					echo "<div class=\"col-md-3 col-md-offset-4 ask-cpt\">";
						echo "<div id=\"create_cpt\">";
							echo "<h3>Ste kapitán tímu ?</h3>";
							echo "<button id=\"cpt_true\" onclick=\"updateCaptain(".$uid.",".$group_id.")\">Áno, chcem rozdeliť body</button>";
							echo "<button id=\"cpt_false\">Nie</button>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			}else{
				if($cpt_name['id_person'] == $uid){
					$captain = "Ste kapitánom tímu";
					if($status == null){
						$is_cpt = true;					
					}
				}
				else $captain = $cpt_name['name']." ".$cpt_name['surname'];
			}
		?>
		<script>
			$("#cpt_false").click(function(){
				$("#students input").prop("disabled", true);
				$("#create_cpt").html("");
			});
		</script>
		<div class="row header"> <!--header-->
			<div class="col-md-12">
				<div class="col-md-1 col-md-offset-1 logout-right">
					<a href="logout.php">Odhlásiť</a>
				</div>
				<div class="col-md-2">
					<?php echo $login; ?>
				</div>
			</div>
		</div>
		<br><br>
		<script src="updates/updates.js" type="text/javascript"></script>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<div class="row">
					<table id="students">
						<thead>
							<tr>
								<th>MENO</th><th>PRIEZVISKO</th><th>BODY</th><th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								while($student = $students->fetch_array(MYSQL_ASSOC)){
									echo "<tr>";
									echo "<td>".$student['name']."</td>";
									echo "<td>".$student['surname']."</td>";
									echo "<td><input id=\"input_".$student['id_person']."\" type=\"number\" min=\"0\" max=\"".$total_points."\" name=\"".$student['id_person']."\" value=\"".$student['points']."\" onchange=\"updatePoints(this.name, this.value)\" disabled></td>";
									echo "<td id=\"status_".$student['id_person']."\">".$student['status']."</td>";
								}
								
								if($is_cpt){
									if($status == null)
										echo "<script> $(\"#students input\").prop(\"disabled\", false); </script>";
								}				
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-2 team-info">
				<p><b>Číslo tímu</b></p>
				<p><?php echo $group_id; ?></p>
				<p><b>Celkový počet bodov</b></p>
				<p id="total_points"><?php echo $total_points; ?></p>
				<p><b>Kapitán tímu</b></p>
				<p id="cpt"><?php echo $captain; ?></p>
				<p><b>Stav schválenia adminom</b></p>
				<p id="adminApproval">Zatiaľ nekontrolované</p>
				<script>
					setInterval(function(){
						updateAdminApproval(group);
					}, 3000);
				</script>
				<?php 
						if($status == null){
							echo "<div id=\"buttonBox\">";
							echo "<p><b>Potvrďte hodnotenie</b></p>";
							echo "<button class=\"confirm-button\" id=\"alowButton\" value=\"1\">Súhlasím</button>";
							echo "<button class=\"confirm-button\" id=\"denyButton\" value=\"0\">Nesúhlasím</button>";
							echo "</div>";
						}
					?>
			</div>
		</div>
		<div id="myModal" class="modal modal-content">
			<span id="close" class="close">x</span>
			<p>Po potvrdení sa Vaše rozhodnutie nedá zmeniť, ste si istá/ý svojím rozhodnutím ?<button id="acceptButton">Potvrdiť</button><button id="cancelButton">Zrušiť</button></p>
		</div>
		
		<script src="js/handlers_home.js" type="text/javascript"></script>
		<?php $mysqli->close(); ?>
	</body>
</html>
