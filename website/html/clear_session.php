<?php 
	session_start();
	$_SESSION = array();
	header("Location: home.php");

?>