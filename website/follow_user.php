<?php
    if( session_status() != 2 ) {
        session_start();
    }

    $logged_in = False;
    if (isset($_SESSION["handle"])){
        // echo $_SESSION["handle"];
        $logged_in = True;

    } else {
        // echo "Username is not set.";
        $logged_in = False;
    }
	require_once "database.php";
    $database = new Database();
    

	if (isset($_SESSION["handle"]) && isset($_GET["following"])){
		echo $_SESSION["handle"];
		echo $database->follow_user($_SESSION["handle"], $_GET["following"]);
	}

?>