var approval = 'null';
var actualGroup = 0;

$(".alowButton").click(function(){
	$('#myModal').show();
	actualGroup = this.value;
	approval = 1;
});

$(".denyButton").click(function(){
	$('#myModal').show();
	actualGroup = this.value;
	approval = 0;
});

$("#close").click(function(){
	$('#myModal').hide();
	actualGroup = 0;
	approval = 'null';
});

//nefunguje
$("html").click(function(event) {
	if (event.target == $('#myModal')) {
		$('#myModal').hide();
	}
});

$("#adminAcceptButton").click(function(){
		updateApproval(actualGroup,approval);
		$('#myModal').hide();
	});
	
$("#adminCancelButton").click(function(){
	$('#myModal').hide();
	approval=0;
});