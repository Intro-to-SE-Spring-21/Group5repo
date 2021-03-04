// We need this so jshint doesn't throw unnessessary warnings
/*jshint esversion: 6 */
var mysql = require('mysql');
var connection = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: 'password',
	database: 'mydatabase'
});

connection.connect(function(err) {
	if (err) throw err;
	console.log("Connected to mydb!");
	// connection.query("CREATE DATABASE mydb", function (err, result) {
	// 	if (err) throw err;
	// 	console.log("Connected to mydb");
	// });
});


const http = require('http');
const express = require('express');
const path = require('path');
const app = express();
app.use(express.json());
app.use(express.static("express"));// default URL for website
app.use('/', function(req,res){
    res.sendFile(path.join(__dirname+'/express/index.html'));
    //__dirname : It will resolve to your project folder.
  });const server = http.createServer(app);
const port = 3000;
server.listen(port);console.debug('Server listening on port ' + port);