setEventHandlers = function(){
	io.socket.on("connection", onSocketConnection);
};

var openedRooms = new Array();

var jquery = require('jquery');
var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);


app.get('/', function(req, res){
	res.sendFile(__dirname + '/client/index.html');
});

app.use('/client', express.static(__dirname + '/client'));

io.on('connection', function(socket){
	console.log('user connected');
	
	socket.on('new user', function(username){
		console.log('new user > ' + username);
		socket.username = username;
		socket.room = 'default';
		socket.join(socket.room);
		io.to(socket.room).emit('avb rooms', openedRooms);
	});
	
	socket.on('new room', function(room){
		console.log('new room > ' + room + ' from ' + socket.username);
		socket.leave(socket.room);
		socket.room = room;
		socket.join(socket.room);
		openedRooms.push({roomname:room, num_users: 1});		
		io.to('default').emit('avb rooms', openedRooms);
	});
	
	socket.on('join room', function(key){
		var roomname = openedRooms[key].roomname;
		if(openedRooms[key].num_users < 2){
			socket.leave(socket.room);
			socket.room = roomname;
			socket.join(socket.room);
			openedRooms[key].num_users++;	
			io.to(socket.room).emit('room info', "user " + socket.username + " joined");
			socket.join(socket.username);
			io.to(socket.username).emit('joined', '1');
			socket.leave(socket.username);
			console.log( socket.username + ' joined room > ' + socket.room);
		}else{		
			socket.join(socket.username);
			io.to(socket.username).emit('joined', '-1');
			socket.leave(socket.username);
		}
		io.to('default').emit('avb rooms', openedRooms);
	});
	
	socket.on('avb rooms', function(){
		io.to(socket.room).emit('avb rooms', openedRooms);
	});
			
	socket.on('message', function(msg){
		console.log('message ' + msg + ' from ' + socket.username);
		io.to(socket.room).emit('message', msg);		
	});
	
	socket.on('disconnect', function(){
		console.log('user '+ socket.username +'disconnected');
	});
});

server.listen(2000, function(){	
	console.log("listening on 2000");
});
