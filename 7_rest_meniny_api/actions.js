$(document).ready(function(){
	
		var table = $("#myDiv").html();
			$("#myDiv").html("");
			
	$(".date-input").show();		
	$(".name-input").hide();
	$(".add-name-input").hide();
	$(".add-date-input").hide();
	$("#name-by-date-button").show();
	$("#date-by-name-button").hide();
	$("#add-name-button").hide();
	$("#sviatky-list-button").hide();
	$("#dni-list-button").hide();
	
	
	
	$("#find-name").click(function(){
		$(".date-input").show();		
		$(".name-input").hide();
		$(".add-name-input").hide();
		$(".add-date-input").hide();
		$("#name-by-date-button").show();
		$("#date-by-name-button").hide();
		$("#add-name-button").hide();
		$("#sviatky-list-button").hide();
		$("#dni-list-button").hide();
		$(".country").show();
		$("#myDiv").html("");
		$("li").css('border-bottom', '3px solid black');
		$(this).parent().css('border-bottom', '3px solid #1BC98E');
	});
	
	$("#find-date").click(function(){
		$(".date-input").hide();		
		$(".name-input").show();
		$(".add-name-input").hide();
		$(".add-date-input").hide();
		$("#name-by-date-button").hide();
		$("#date-by-name-button").show();
		$("#add-name-button").hide();
		$("#sviatky-list-button").hide();
		$("#dni-list-button").hide();
		$(".country").show();
		$("#myDiv").html("");
		$("li").css('border-bottom', '3px solid black');
		$(this).parent().css('border-bottom', '3px solid #1BC98E');
	});
	
	$("#get-holidays").click(function(){
		$(".date-input").hide();		
		$(".name-input").hide();
		$(".add-name-input").hide();
		$(".add-date-input").hide();
		$("#name-by-date-button").hide();
		$("#date-by-name-button").hide();
		$("#add-name-button").hide();
		$("#sviatky-list-button").show();
		$("#dni-list-button").hide();
		$(".country").show();
		$("#myDiv").html("");
		$("li").css('border-bottom', '3px solid black');
		$(this).parent().css('border-bottom', '3px solid #1BC98E');
	});
	
	$("#get-memory-days").click(function(){
		$(".date-input").hide();		
		$(".name-input").hide();
		$(".add-name-input").hide();
		$(".add-date-input").hide();
		$("#name-by-date-button").hide();
		$("#date-by-name-button").hide();
		$("#add-name-button").hide();
		$("#sviatky-list-button").hide();
		$("#dni-list-button").show();
		$(".country").show();
		$("#myDiv").html("");
		$("li").css('border-bottom', '3px solid black');
		$(this).parent().css('border-bottom', '3px solid #1BC98E');
	});
	
	$("#add-name").click(function(){
		$(".date-input").hide();		
		$(".name-input").hide();
		$(".add-name-input").show();
		$(".add-date-input").show();
		$("#name-by-date-button").hide();
		$("#date-by-name-button").hide();
		$("#add-name-button").show();
		$("#sviatky-list-button").hide();
		$(".country").hide();
		$("#dni-list-button").hide();
		$("#myDiv").html("");
		$("li").css('border-bottom', '3px solid black');
		$(this).parent().css('border-bottom', '3px solid #1BC98E');
	});
	
	$('#name-by-date-button').click(function(){
				var date = dateToXXXXFormat($('#date-input').val());
				var countryCode = $('#country').val();
				var request = "http://147.175.98.229/6Zadanie/index.php/" + countryCode + "/meniny/" + date;
				 $.ajax({
					 type: 'GET',
					 url: request,
					 success: function(msg){
						var json = jQuery.parseJSON(msg);	
						console.log(json);
						$("#myDiv").html(table);						
						$("#table tbody").append("<tr><td>"+json.den+"</td><td><b>"+json.meno+"</b></td></tr>");
					 }
				 });					
			});
			
			$('#date-by-name-button').click(function(){
				var nameInput = $("#name-input").val();
				var countryCode = $('#country').val();
				var request = "http://147.175.98.229/6Zadanie/index.php/" + countryCode + "/meniny?q=" + nameInput;
				 $.ajax({
					 type: 'GET',
					 url: request,
					 success: function(msg){
						var json = jQuery.parseJSON(msg);
						console.log(json);
						$("#myDiv").html(table);						
						$("#table tbody").append("<tr><td><b>"+json.den+"</b></td><td>"+json.meno+"</td></tr>");
					 }
				 });					
			});
			
			$('#sviatky-list-button').click(function(){
				var countryCode = $('#country').val();
				var request = "http://147.175.98.229/6Zadanie/index.php/" + countryCode + "/sviatky";
				 $.ajax({
					 type: 'GET',
					 url: request,
					 success: function(msg){
						var json = jQuery.parseJSON(msg);
						console.log(json);
						alert(json);
						$("#myDiv").html(table);
						$.each(json, function(idx, obj){	
							$("#table tbody").append("<tr><td>"+obj.den+"</td><td>"+obj.title+"</td></tr>");
						});
					 }
				 });					
			});
			
			$('#dni-list-button').click(function(){
				var countryCode = $('#country').val();
				var request = "http://147.175.98.229/6Zadanie/index.php/" + countryCode + "/dni";
				 $.ajax({
					 type: 'GET',
					 url: request,
					 success: function(msg){
						var json = jQuery.parseJSON(msg);
						console.log(json);
						$("#myDiv").html(table);
						$.each(json, function(idx, obj){	
							$("#table tbody").append("<tr><td>"+obj.den+"</td><td>"+obj.title+"</td></tr>");
						});
					 }
				 });					
			});
			
			$('#add-name-button').click(function(){
				var date = dateToXXXXFormat($('#add-date-input').val());
				var name = $('#add-name-input').val();
				var request = "http://147.175.98.229/6Zadanie/index.php/sk/meniny/"+date+"?q="+name;
				 $.ajax({
					 type: 'POST',
					 url: request,
					 success: function(msg){
						var json = jQuery.parseJSON(msg);  
						console.log(json);
						$("#myDiv").append(table);						
						$("#table tbody").append("<tr><td>"+json.den+"</td><td><b>"+json.meno+"</b> - "+json.other+"</td></tr>");
					 }
				 });					
			});
			
			
			
			function dateToXXXXFormat(date){
				var date = new Date(date);
				var month = ("0" + (date.getMonth() + 1)).slice(-2);
				var day = ("0" + (date.getDate())).slice(-2);
				return month + day;
			}
	
});