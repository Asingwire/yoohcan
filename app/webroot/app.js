// This is the main file of our chat app. It initializes a new 
// express.js instance, requires the config and routes files
// and listens on a port. Start the application by running
// 'node app.js' in your terminal


var express = require('express'),
	app = express();
var http = require('http');

var fs = require('fs');

var options = {
  // key: fs.readFileSync('/etc/ssl/private/www.wolero.com.key'),
  // cert: fs.readFileSync('/etc/ssl/certs/www.wolero.com.crt')
 /*  key: fs.readFileSync('/home/woleroc/ssl/keys/d8c2f_57bed_d8168339c15bf60150ddb2d4ebc8d252.key'),
  cert: fs.readFileSync('/home/woleroc/ssl/certs/www_wolero_com_d8c2f_57bed_1460764799_e99cecc16e18c46627d6b85c98e4424a.crt') */
};
	
var gravatar = require('gravatar');
var moment = require('moment-timezone');
var mysql = require('mysql');
var underscore = require('underscore');
var apns = require('apn'); // for iphone
var gcm = require('node-gcm'); // for android

/* var db_config = {
  host: 'localhost',
    user: 'root',
    password: '',
    database: 'yoohcan'
}; */// local

var db_config = {
  host: 'localhost',
    user: 'root',
    password: 'yoohcan@123',
    database: 'yoohcan'
}; //live

var connection;
var last_record_added='';
function handleDisconnect() {
  mysqlConnection = mysql.createConnection(db_config); // Recreate the connection, since
                                                  // the old one cannot be reused.

  mysqlConnection.connect(function(err) {              // The server is either down
    if(err) {                                     // or restarting (takes a while sometimes).
      console.log('error when connecting to db:', err);
      setTimeout(handleDisconnect, 2000); // We introduce a delay before attempting to reconnect,
    }                                     // to avoid a hot loop, and to allow our node script to
  });                                     // process asynchronous requests in the meantime.
                                          // If you're also serving http, display a 503 error.
  mysqlConnection.on('error', function(err) {
    console.log('db error', err);
    if(err.code === 'PROTOCOL_CONNECTION_LOST') { // Connection to the MySQL server is usually
      handleDisconnect();                         // lost due to either server restart, or a
    } else {                                      // connnection idle timeout (the wait_timeout
      throw err;                                  // server variable configures this)
    }
  });
}

handleDisconnect();

// This is needed if the app is run on heroku:

var port = process.env.PORT || 3000;

// Initialize a new socket.io object. It is bound to 
// the express app, which allows them to coexist.

//var io = require('socket.io').listen(https.createServer(options, app).listen(port));
var io = require('socket.io').listen(http.createServer(app).listen(port));

//console.log(io);
// Require the configuration and the routes files, and pass
// the app and io as arguments to the returned functions.

//require('./config')(app, io);
//require('./routes')(app, io);
console.log('Your application is running on http://yoohcan.tv:' + port);

io.sockets.on('connection', function (socket) {
	
	socket.on('join_room', function (data) {
	
	
		 //console.log(data);
		if (typeof socket !== 'undefined') {
			// data.id should be set if user is logged in
			if (typeof data.id !== 'undefined') {
				// Check if socket is already in room
				var roomlist = findClientsSocket(io, data.id, '');
				//console.log(roomlist.length);
				//if (roomlist.length <=1) {
				
					
					 //var roomlist = io.sockets.clients(data.id); // returns Socket instances of all clients in the room
					  
					var occupantSocket;
					if (typeof roomlist[0] !== 'undefined') {
					   // Should only be one socket in a private room
					   occupantSocket = roomlist[0];
					}
					//if (socket !== occupantSocket) {
					   // Socket hasn't joined before so join it now
					   socket.join(data.id);
					//}
					socket.username = data.username;
					socket.room = data.id;
					
					if (typeof data.image !== 'undefined') {
						if(data.image == "")
						{
						socket.avatar = gravatar.url(data.image, {s: '140', r: 'x', d: 'mm'});
						}
						else
						{
							socket.avatar = data.image;
						}
						socket.emit('img', socket.avatar);
					}
					else
					{
						socket.avatar = data.image;
						socket.emit('img', socket.avatar);
					}
				/* }
				else
				{
					console.log('many');
					socket.emit('tooMany', {boolean: false});
				} */
				
			} 
			else 
			{
				// User ID isn't set so disconnect the socket
				socket.disconnect();
			}
		}
		
		
		
		
		socket.on('msg', function(data){
			var input = {
				sender_id:data.SenderId,
				recording_stream_id :data.recordingId,
				recording_key:data.id,
				stream_id:data.streamId,
				stream_key:data.streamKey,
				message:data.msg,
				created:moment().tz("UTC").format()
			};
				mysqlConnection.query("INSERT INTO messages set ? ",input, function(err, results) {
					  console.log(results);
					 
					 
				});	 
			
			
			
			
			
			 socket.broadcast.to(socket.room).emit('receive', {msg: data.msg, user: data.user, img: data.img,SenderId:data.SenderId,streamId:data.streamId,Id:data.id}); 
			 
			
		});
			
	});
	
	
	
	
	
	socket.on('join_room_stream', function (data) {
	
	
		 //console.log(data);
		if (typeof socket !== 'undefined') {
			// data.id should be set if user is logged in
			if (typeof data.id !== 'undefined') {
				// Check if socket is already in room
				var roomlist = findClientsSocket(io, data.id, '');
				//console.log(roomlist.length);
				//if (roomlist.length <=1) {
				
					
					 //var roomlist = io.sockets.clients(data.id); // returns Socket instances of all clients in the room
					  
					var occupantSocket;
					if (typeof roomlist[0] !== 'undefined') {
					   // Should only be one socket in a private room
					   occupantSocket = roomlist[0];
					}
					//if (socket !== occupantSocket) {
					   // Socket hasn't joined before so join it now
					   socket.join(data.id);
					//}
					socket.username = data.username;
					socket.room = data.id;
					
					if (typeof data.image !== 'undefined') {
						if(data.image == "")
						{
						socket.avatar = gravatar.url(data.image, {s: '140', r: 'x', d: 'mm'});
						}
						else
						{
							socket.avatar = data.image;
						}
						socket.emit('img', socket.avatar);
					}
					else
					{
						socket.avatar = data.image;
						socket.emit('img', socket.avatar);
					}
				/* }
				else
				{
					console.log('many');
					socket.emit('tooMany', {boolean: false});
				} */
				
			} 
			else 
			{
				// User ID isn't set so disconnect the socket
				socket.disconnect();
			}
		}
		
		
		
		
		socket.on('msg_stream', function(data){
			var input = {
				sender_id:data.SenderId,
				stream_id:data.streamId,
				stream_key:data.id,
				message:data.msg,
				created:moment().tz("Asia/Singapore").format()
			};
				mysqlConnection.query("INSERT INTO messages set ? ",input, function(err, results) {
					  console.log(results);
					 
					 
				});	 
			
			 socket.broadcast.to(socket.room).emit('receive_stream', {msg: data.msg, user: data.user, img: data.img,SenderId:data.SenderId,streamId:data.streamId,Id:data.id}); 
			 
			
		});
			
	});
	
	
	
	
	
	
	
	
	
	
	
	

	socket.on('disconnect', function() {
	
		io.sockets.emit('driver_disconnected',this.room);	
		socket.broadcast.to(this.room).emit('leave', {
				boolean: true,
				room: this.room,
				user: this.username,
				avatar: this.avatar
			});
			
			// leave the room
			socket.leave(socket.room);
	});
	
	function findClientsSocket(io,roomId, namespace) {
		var res = [],
			ns = io.of(namespace ||"/");    // the default namespace is "/"
		//console.log(ns);
		if (ns) {
			//console.log('if');
			for (var id in ns.connected) {
				if(roomId) {
					var index = ns.connected[id].rooms.indexOf(roomId) ;
					if(index !== -1) {
						res.push(ns.connected[id]);
					}
				}
				else {
					res.push(ns.connected[id]);
				}
			}
		}
		return res;
	}
	

});



