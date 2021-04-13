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
    $result = $database->get_following($_SESSION["handle"]);
    $followers_list = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          if ($row["following_handle"] == $_GET["handle"]){
            echo "true";
            return true;
            // $followers_list[$i] = $row["following_handle"];
          }
      }
    } else { echo "Following no one"; }
?>
