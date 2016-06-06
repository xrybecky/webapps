$("document").ready(function(){				
	$( "#target" ).mousemove(function( event ) {
		var msg = "Handler for .mousemove() called at ";
		msg += event.pageX + ", " + event.pageY;
		console.log( "<div>" + msg + "</div>" );
		$("#movingobject").css('transform', 'translate(' + (-(event.pageX /16)+40) + 'px,' + 0 + 'px)');
	});
});