var mainComment = $('.msg').html();
$('.msg').empty();
			
var mainPost = $('#mainDash').html();
$('#mainDash').empty();

var actualRoom = 0;
	
	$( document ).ready(function() {
			console.log("ready");
			setUserInfo();
			//startDash();
		
	});
		
	$("#dash").click(function(){
		startDash();
	});	
		
	function setUserInfo(){
		$.getJSON( "/nest/user/user-info", function( data ) {
			var items = [];
  
			$.each( data, function( key, val ) {
				items.push( "<li id='" + key + "'>" + val + "</li>" );
			});
			
			$.each(data.rooms, function(index, element){
				$("#room_list").append('<li id="room'+element.id+'"><a href="#">'+element.name+'</a></li>');
				$("#room"+element.id).click(function(){
					setRoom(element.id);
				});
			});
			
			$("h3").append(""+data.nick);
			$("h4").append(""+data.nick);
		});
	}
	
	function setPostAttr(post, element){
		$(".creatorAvatar",post).attr("src","/nest"+element.creatorAvatarImg);
		$(".creatorName",post).text(element.creatorNick);
		$(".date",post).text(element.modified);
		$(".postText",post).text(element.text);
		$(".countLikes",post).text(element.likes);
		$(".post", post).attr("id",element.id);
		
		$(".add-like", post).click(function(e){
			$.getJSON( "/nest/user/add-like?messageId="+element.id, function( likes ) {
				$(".countLikes", post).text(likes);
			});
			return false;
		});
	}
	
	function setCommentAttr(comment,element){
		$(".commentImg",comment).attr("src","/nest"+element.creatorAvatarImg);
		$(".comment-autor",comment).text(element.creatorNick);
		$(".comment-text",comment).text(element.text);
		$(".countCommentLikes",comment).text(element.likes);
		$(".add-comment-like",comment).click(function(e){
			$.getJSON("/nest/user/add-like?messageId="+element.id, function( likes ){
				$(".countCommentLikes", comment).text(likes);
			});
			return false;
		});
	}
	
	function getPosts(data){
		$('#mainDash').empty();
			$(data).each(function(index, element){
				var post = $(mainPost);
				setPostAttr(post,element);
				if(element.children != null){
					$(".countComment",post).text(element.children.length);
					getComments(element.children,post);
				}
				$('#mainDash').append(post);
			});
	}
	
	function getComments(data,post){
	var comment; 
			$(data).each(function(index, element){
				comment = $(mainComment);
				setCommentAttr(comment,element);
				$('.msg',post).append(comment);
			});
	}
	
	function createPost(){
		if(actualRoom != 0){
			text = $('#postText').val();
			$('#postText').val("");
			if(text.length != 0 || text.length < 2000){
				$.ajax({
					dataType: "json",
					url: "/nest/user/create-post",
					data: {roomId: actualRoom, post: text},
					success:function(data){
								setRoom(actualRoom);
							}
				});
			}else{ alert("Neplatny text");}
		}
	}
	
	$(document).on('click','.commentButton',function(){
		createComment($(this));
	});
	
	function createComment(commentButton){
		
		
		if(actualRoom != 0){
			var div = commentButton.closest("div");
			text = div.find("input").val();
			id = div.attr("id");
			
			if(text.length != 0 || text.length < 2000){
				$.ajax({
					dataType: "json",
					url: "/nest/user/create-comment",
					data: {parentId: id, comment: text},
					success:function(data){
								setRoom(actualRoom);
								$('.commentText').val("");
							}
				});
				
			}else{ alert("Neplatny text");}
		}
	}
	
	function setRoom(id) {
		actualRoom = id;
		$.ajax({
			dataType: "json",
			url: "/nest/user/select-room-messages",
			data: {roomId: id, last: 0},
			success:function(data) {
						getPosts(data);
					}
		});
	}
	
	function startDash(){
		actualRoom = 0;
		$.getJSON( "/nest/user/select-dashboard-messages?last=0", function(dashData) {
			getPosts(dashData);
		});
	}
	
	
	
	
	
	
	
	
	
	
	
	
	