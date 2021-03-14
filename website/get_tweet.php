<?php
    // Add this before trying to access database contents
    require_once 'anon_login.php';
    $tid = $_POST['tweet_id'];
    $column = $_POST['column'];
    echo $column;
    $conn = new mysqli($hn, $un, $pw, $db, $port);

    if ($conn->connect_error) {
        die('Connect Error ('.$conn->connect_errno.') '. $conn->connect_error);
    }

    // echo 'Connection OK '. $conn->host_info.'<br>';
    // echo 'Server '.$conn->server_info.'<br>';
    // echo 'Initial charset: '.$conn->character_set_name().'<br>';


    $result = $conn->query("SELECT * from tweets");
    $current_likes = 0;
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
             $col_data = $row[$column];
        }
    }

    // $row_data = mysql_fetch_array($result);
    echo $col_data;
    // if($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()){
    //         echo "<p id='".$row["tid"]
    //         ."' class='leftColumnTitle' onclick=\"display_tweet("
    //         .$row["tid"]. ", '" .$row["tweet_title"]. "','" .$row["content"]. "','".$row["total_likes"]."')\">"     // DATA FROM HERE
    //         . $row["tweet_title"] 
    //         . "</p><br>";
    //     }
    // } else { echo "No tweets found in table."; }

    $conn->close(); // Close the connection when we're done
?>