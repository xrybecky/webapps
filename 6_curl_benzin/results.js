$(document).ready(function(){
	var table = $("#results-container").html();
	
	if(typeof j ==='undefined'){
		$('#results-container').hide();
		$("#results-container").html('');
	}else{
		if(j == -1){
			$("#psc").focus();
			$("#psc").css('border', '2px solid red');
			$('#results-container').hide();
			$("#results-container").html('');
		}else if(typeof j === 'string'){
			$('#results-container').show();
			$('#results-container').html('<p class="no-results">'+j+'</p>');
		}else{
			console.log(j);
			$('#results-container').show();
			$('#results-container').html(table);
			
			$.each(j, function(i, obj){
				$("#results-table > tbody").append('<tr class="tr-s"></tr>');
				
				$("#results-table > tbody > tr:last").append('<td>'+obj.station+'</td>');
				$("#results-table > tbody > tr:last").append('<td>'+obj.place+'</td>');
				$("#results-table > tbody > tr:last").append('<td>'+obj.street+'</td>');
				$("#results-table > tbody > tr:last").append('<td><img alt="Cena" src="'+obj.price+'"> €</td>');
				$("#results-table > tbody > tr:last").append('<td>'+obj.date+'</td>');
				
			});
		}
	}
});

