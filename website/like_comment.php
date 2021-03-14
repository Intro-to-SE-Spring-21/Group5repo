<?php
	require_once "login.php";
	$tid = $_POST['tweet_id'];
	$increment = $_POST['increment'];
	// echo $increment;
	$conn = new mysqli($hn, $un, $pw, $db, $port);

	if ($conn->connect_error) {
	    die('Connect Error ('.$conn->connect_errno.') '. $conn->connect_error);
	}

	// echo 'Connection OK '. $conn->host_info.'<br>';
	// echo 'Server '.$conn->server_info.'<br>';
	// echo 'Initial charset: '.$conn->character_set_name().'<br>';


	$result = $conn->query("SELECT total_likes from tweets WHERE tid=".$tid);

	$current_likes = 0;
	if($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()){
	         $current_likes = $row["total_likes"];
	         // echo $current_likes;
	    }
	}

	$likes = $current_likes;
	if ($increment == "true"){
		// echo " Increment evaluates as true. ";
		$update = "UPDATE `tweets` SET `total_likes` = '" . ($current_likes+1) . "' WHERE `tweets`.`tid` = " . $tid . ";";
		if(mysqli_query($conn, $update)){
	    	echo ($current_likes+1);
		} else {
		    echo "ERROR: Could not able to execute $insert_query <br>" . mysqli_error($conn);
		}
	} else {
		echo $current_likes;
	}

	

?>