<?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db, $port);

    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') '. $conn->connect_error);
    }

    // echo 'Connection OK '. $conn->host_info.'<br>';
    // echo 'Server '.$conn->server_info.'<br>';
    // echo 'Initial charset: '.$conn->character_set_name().'<br>';


    $result = $conn->query("SELECT * from testtweets");
    if($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()){
	        echo "<p class='leftColumnTitle'>" . $row["title"] . "</p><br>";
	    }
    } else { echo "No tweets found in table."; }
    echo $_POST['bTitle'];
    echo "<br>";
    echo $_POST['bText'];


    // Close the connection when we're done
    $conn->close();

	// echo $_POST['bTitle'];
	// echo $_POST['bText'];
	// header("Location: home.php");
?>