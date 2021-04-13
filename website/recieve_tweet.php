<?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db, $port);

    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') '. $conn->connect_error);
    }

    // echo 'Connection OK '. $conn->host_info.'<br>';
    // echo 'Server '.$conn->server_info.'<br>';
    // echo 'Initial charset: '.$conn->character_set_name().'<br>';

    $username = "anon";


    $title = "'".$_POST['bTitle']."'";
    $body = $_POST['bText'];
    $body = str_replace("'","\'",$body);
    $body = "'".$body."'";
    echo $body;
    $handle = "'".$_POST['bSubmit']."'";
    $insert_query = "INSERT INTO tweets (tid, handle, tweet_title, content, date_posted) VALUES (0, ".$handle.", ".$title.", ".$body.", current_timestamp());";

    # REMEMBER: RELATE USERS TO THE TWEETS THEY POST ONCE USERS TABLE IS SET UP

    //mysqli_query($conn, $query);
    if(mysqli_query($conn, $insert_query)){
    	echo " -Records inserted successfully.<br>";
	} else {
	    echo " -ERROR: Could not able to execute $insert_query <br>" . mysqli_error($conn);
	}

    $result = $conn->query("SELECT * from tweets");
    if($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()){
	        echo $row["tweet_title"] . " - " . $row["content"] . " - " . $row["tid"] . " - " . $row["date_posted"] . "<br>";
	    }
    } else { echo " -No tweets found in table."; }
    // echo $_POST['bTitle'];
    // echo "<br>";
    // echo $_POST['bText'];


    // Close the connection when we're done
    $conn->close();

	// echo $_POST['bTitle'];
	// echo $_POST['bText'];
	header("Location: home.php");
?>