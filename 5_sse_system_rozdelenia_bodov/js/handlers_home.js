var status = 'null';
			
$("#alowButton").click(function(){
	$('#myModal').show();
	status = this.value;
});

$("#denyButton").click(function(){
	$('#myModal').show();
	status = this.value;
});

$("#close").click(function(){
	$('#myModal').hide();
	status = 'null';
});

//nefunguje
$("html").click(function(event) {
	if (event.target == $('#myModal')) {
		$('#myModal').hide();
	}
});

$("#acceptButton").click(function(){
	var uid = $('#uid').html();
	updateStatus(uid,status);
	$('#myModal').hide();
});
	
$("#cancelButton").click(function(){
	$('#myModal').hide();
	status = 'null';
});
