function updateApproval(group, approval){
	$.ajax({
		type: "POST",
		url: 'updates/update_approval.php',
		dataType: 'json',
		data: 'group='+group+'&approval='+approval,
		success: function(approval){
			if(approval == 0){
				$('#approval_'+group).hide();
				$('#th_approval_'+group).html("Neschválené");
			}			
			else if(approval == 1){
				$('#approval_'+group).hide();
				$('#th_approval_'+group).html("Schválené");
			}
		}
	});
}
			
function updatePoints(idPerson, points){
	$.ajax({
		type: "POST",
		url: 'updates/update_points.php',
		dataType: 'json',
		data: 'idPerson='+idPerson+'&points='+points,
		success: function(points){
			$('#'+idPerson).value = points;
		}
	});
}

function updateStatus(idPerson, status){
	$.ajax({
		type: "POST",
		url: 'updates/update_status.php',
		dataType: 'json',
		data: 'idPerson='+idPerson+'&status='+status,
		success: function(status){
			if(status == 0){
				$('#status_'+idPerson).html("Nesúhlasím");
			}else if(status == 1){
				$('#status_'+idPerson).html("Súhlasím");
			}
			if(status != 'null'){
				$('#buttonBox').hide();
				$("#students input").prop("disabled", true);
				$.getScript("newsse.js");
			}
		}
	});
}

function updateCaptain(idPerson, group){
	$("#students input").prop("disabled", false);
	$.ajax({
		type: "POST",
		url: 'updates/update_cpt.php',
		dataType: 'json',
		data: 'idPerson='+idPerson+'&group='+group,
		success: function(captain){
			$("#create_cpt").html("");
			$("#cpt").html(captain.name+" "+captain.surname);
		}
	});
}

function updateAdminApproval(group){
	$.ajax({
		type: "POST",
		url: 'updates/get_approval.php',
		dataType: 'json',
		data: 'group='+group,
		success: function(approval){
			switch(approval){
				case 0: $("#adminApproval").html("Neschválené");
					break;
				case 1: $("#adminApproval").html("Schválené");
					break;
				default:$("#adminApproval").html("Zatiaľ nekontrolované");
			}
		}
	});
}
