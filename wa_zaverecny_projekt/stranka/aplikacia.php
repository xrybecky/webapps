<!DOCTYPE HTML>
<html>
    <head>
		<meta charset="utf-8">
		<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript" src="canvasjs/canvasjs.min.js"></script>
		<link rel="stylesheet" href="css/app-style.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style-aktualit.css">
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" type="text/css">
		
		<?php
			$translate['header']['sk'] = 'Aplikácia';
			$translate['header']['en'] = 'Application';
			$translate['calc']['sk'] = 'Počítať';
			$translate['calc']['en'] = 'Calculate';
			$translate['fun']['sk'] = 'Funkcia';
			$translate['fun']['en'] = 'Function';
			$translate['from']['sk'] = 'Od';
			$translate['from']['en'] = 'From';
			$translate['to']['sk'] = 'Do';
			$translate['to']['en'] = 'To';
			$translate['step']['sk'] = 'Krok';
			$translate['step']['en'] = 'Step';
			$translate['graph']['sk'] = 'Graf funkcie';
			$translate['graph']['en'] = 'Graph of the function';
			$translate['derivate']['sk'] = 'Graf derivácie funkcie';
			$translate['derivate']['en'] = 'Graph of the derivative function';
			$lang = $_SESSION['lang'];
		?>
        <title><?php echo $translate['header'][$lang]; ?></title>
        <script>
			$(function(){
				var chart = new CanvasJS.Chart("chartContainer", {
					backgroundColor: "rgba(255, 255, 255, 0.7)",
					title:{
						text: "Graf funkcie"       
					},
					axisY:{
						lineColor: "black",
						gridColor: "black",
						gridThickness: "1",
						lineThickness: "1",
						labelFontColor: "black"		
					},
					axisX:{
						lineColor: "black",
						gridThickness: "1",
						lineThickness: "1",
						gridColor: "black",
						labelFontColor: "black"		
					},
					data: [
						{			
							type: "spline",
							lineColor: "#00FFAB",
							markerType: "none",
							dataPoints: [
								{x:0, y:0}
							]
						}
					]
				});
				var chartDiff = new CanvasJS.Chart("chartContainerDiff", {
					backgroundColor: "rgba(255, 255, 255, 0.7)",
					title:{
						text: "Graf derivácie funkcie"  
					},
					axisY:{
						lineColor: "black",
						gridThickness: "1",
						lineThickness: "1",
						gridColor: "black",
						labelFontColor: "black"
					},
					axisX:{
						lineColor: "black",
						gridThickness: "1",
						lineThickness: "1",
						gridColor: "black",
						labelFontColor: "black"					
					},
					data: [
						{
							type: "spline",
							lineColor: "00FFAB",
							markerType: "none",
							dataPoints: [
								{x:0, y:0}
							]
						}
					]
				});
				chart.render();
				chartDiff.render();
			  
				var source;
				$("#update-function").click(function(){
					var begin = $("#x-axis-begin").val();
					var end = $("#x-axis-end").val();
					var step = $("#x-axis-step").val();
					var func = $("#function").val();
					
					if(source != null){
						chart.options.data[0].dataPoints = [];					
						chartDiff.options.data[0].dataPoints = [];
						source.close(); 
					}
					
					var is = 0;
					if(typeof(EventSource) !== "undefined") {					
						chart.options.data[0].dataPoints = [];					
						chartDiff.options.data[0].dataPoints = [];
						
						source = new EventSource("app/maxima.php?begin="+begin+"&end="+end+"&step="+step+"&func="+encodeURIComponent(func));
						
						source.addEventListener("message", function(e) {
							var data = JSON.parse(e.data);
							console.log("*"+data.x);
							if(data.x == begin && is == 1){
								source.close();
							}else{
								chart.options.data[0].dataPoints.push({x: parseFloat(data.x), y: parseFloat(data.y)}); 
								chartDiff.options.data[0].dataPoints.push({x: parseFloat(data.x), y: parseFloat(data.yd)}); 
								chart.render();
								chartDiff.render();
								if(data.x == begin)
									is = 1;
							}						
						}, false);
					}
				});				
			});
		</script>
    </head>
    <body class="inner">
		<?php 
			include('menu.php');
		?>
		<div class="row">
			<div class="col-md-12">
				<h1><?php echo $translate['header'][$lang]; ?></h1>
			</div>
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-12">
						<div class="form-inline">
							<div class="form-group">
								<label for="x-axis-begin" class="control-label"><?php echo $translate['from'][$lang]; ?></label>	
								<input type="number" id="x-axis-begin" placeholder="<?php echo $translate['from'][$lang] . '...'; ?>" class="form-control">
							</div>
							<div class="form-group">
								<label for="x-axis-end" class="control-label"><?php echo $translate['to'][$lang]; ?></label>	
								<input type="number" id="x-axis-end" placeholder="<?php echo $translate['to'][$lang] . '...'; ?>" class="form-control">
							</div>
							<div class="form-group">
								<label for="x-axis-step" class="control-label"><?php echo $translate['step'][$lang]; ?></label>	
								<input type="number" id="x-axis-step" placeholder="<?php echo $translate['step'][$lang] . '...'; ?>" class="form-control">
							</div>
							<div class="form-group">
								<label for="function" class="control-label"><?php echo $translate['fun'][$lang]; ?></label>	
								<input type="text" id="function" placeholder="<?php echo $translate['fun'][$lang] . '...'; ?>" class="form-control">
							</div>
							<button id="update-function" class="btn btn-warning"><?php echo $translate['calc'][$lang]; ?></button>
						</div>
					</div>				
				</div>
			</div>
			<div class="row graph-container">
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<div class="col-md-6">
							<div id="chartContainer" class="chart"></div>
						</div>
						<div class="col-md-6">
							<div id="chartContainerDiff" class="chart"></div>
						</div>
					</div>
				</div>
			</div>
		</div>		
    </body>
</html>
