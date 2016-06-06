<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/dialog-style.css">
		<script src="updates/updates.js"></script>
		
		<title>Home admin</title>
		
		<?php include("config.php");
			session_start();
			
			if(isset($_SESSION['user']) && isset($_SESSION['role']) && $_SESSION['role'] == 1){
				$login = $_SESSION['user'];
			
				$query_group_num = "SELECT MAX(id_group) AS num FROM hodnotenie";
				$group_num = $mysqli->query($query_group_num)->fetch_object()->num;
			}else{ 
				header("Location: index.php"); 
			}
		?>
		<script>
			var groupNum = <?php echo $group_num; ?>;
		</script>
	</head>
	<body>
		<script src="sse/admin_sse.js" type="text/javascript"></script>
		
		<div class="row header"> <!--header-->
			<div class="col-md-12">
				<div class="col-md-1 col-md-offset-1 logout-right">
					<a href="logout.php">Odhlásiť</a>
				</div>
				<div class="col-md-2">
					<?php echo $login; ?> 
				</div>
				<div class="col-md-2 col-md-offset-1">
				Administrácia
				</div>
			</div>
		</div>
		<?php include("load_groups.php"); ?>
		
		<div id="myModal" class="modal modal-content">
			<span id="close" class="close">x</span>
			<p>Po potvrdení sa Vaše rozhodnutie nedá zmeniť, ste si istá/ý svojím rozhodnutím ?<button id="adminAcceptButton">Potvrdiť</button><button id="adminCancelButton">Zrušiť</button></p>
		</div>
		<script src="js/handlers_admin.js" type="text/javascript"></script>
		
		<?php $mysqli->close(); ?>
	</body>
</html>