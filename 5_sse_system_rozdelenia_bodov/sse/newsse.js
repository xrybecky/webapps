
if(typeof(EventSource) !== "undefined") {
				
	var source = new EventSource("sse/php_new_sse.php?g="+group);
	
	source.addEventListener("message", function(e) {
		var data = JSON.parse(e.data);
		console.log(data);
		$.each(data, function(i, student){
			$("#input_"+student["id_person"]).prop('value', student["points"]);	
			if(student["status"] == 0)
				$("#status_"+student["id_person"]).html("Nesúhlasím");	
			else if(student["status"] == 1)
				$("#status_"+student["id_person"]).html("Súhlasím");	
			else $("#status_"+student["id_person"]).html("Žiadna odpoveď");	
		});
	}, false);
	
	source.addEventListener("open", function(e) {
	console.log("open");
	}, false);

} else {
	console.log("not sse support");
	// Sorry! No server-sent events support..
}
