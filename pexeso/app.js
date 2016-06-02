setEventHandlers = function(){
	io.socket.on("connection", onSocketConnection);
};

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
	socket.on('message', function(m){
			console.log('' + m);
	});
	
	socket.on('disconnect', function(){
		console.log('user disconnected');
	});
});

server.listen(2000, function(){	
	console.log("listening on 2000");
});
