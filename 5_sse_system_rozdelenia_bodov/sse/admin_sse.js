
if(typeof(EventSource) !== "undefined") {
				
	var source = new EventSource("sse/php_admin_sse.php?num="+groupNum);
	
	source.addEventListener("message", function(e) {
		var data = JSON.parse(e.data);
		console.log(data);
		
		$.each(data, function(i, group){
			$.each(group, function(i, student){
			$("#points_"+student["id_person"]).html(student["points"]);		
			if(student["status"] == 0)
				$("#status_"+student["id_person"]).html("Nesúhlasím");	
			else if(student["status"] == 1)
				$("#status_"+student["id_person"]).html("Súhlasím");	
			else $("#status_"+student["id_person"]).html("Žiadna odpoveď");					
			});
		});
	}, false);
	
	source.addEventListener("open", function(e) {
	console.log("open");
	}, false);

} else {
	console.log("not sse support");
	// Sorry! No server-sent events support..
}
