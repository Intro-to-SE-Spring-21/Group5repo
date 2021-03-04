// We need this so jshint doesn't throw unnessessary warnings
/*jshint esversion: 6 */

var mysql = require('mysql');
var connection = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: 'password',
	//database: 'mydatabase'
});

connection.connect(function(err) {
	if (err) throw err;

	console.log("Connected to mydb!");
	// connection.query("CREATE DATABASE mydb", function (err, result) {
	// connection.query("SELECT mydatabase", function (err, result) {
	// 	if (err) throw err;
	// 	console.log(result);
	// });

	connection.query("CREATE DATABASE IF NOT EXISTS testdb;", function (err, result) {
		if (err) throw err;
		//console.log(result);
	});

	connection.query("USE mydatabase", function (err, result) {
		if (err) throw err;
		//console.log(result);
		connection.query("USE mydatabase;")
	});

	connection.query("SELECT * FROM users", function (err, result) {
		if (err) throw err;
		console.log(result);
	});

});



// var bodyParser = require('body-parser');

// app.post('/sms', function (req, res) {
//   const body = req.body.Body
//   res.set('Content-Type', 'text/plain')
//   res.send(`You sent: ${body} to Express`)
// })


const http = require('http');
const express = require('express');
const path = require('path');
const app = express();
app.use(express.json());
app.use(express.static("express"));// default URL for website
app.use('/', function(req,res){
    res.sendFile(path.join(__dirname+'/express/index.html'));
    //__dirname : It will resolve to your project folder.
  });
const server = http.createServer(app);
const port = 3000;
server.listen(port);
console.debug('Server listening on port ' + port);