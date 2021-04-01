<?php
	require_once "database.php";
    $database = new Database();
    

	if (isset($_POST["follower"]) && isset($_POST["following"])){
		echo $_POST["follower"];
		echo $database->follow_user($_POST["follower"], $_POST["following"]);
	}

?>