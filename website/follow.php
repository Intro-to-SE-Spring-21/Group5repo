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

?>

<!DOCTYPE html>
<html>
<head lang="en-us"> <!-- Meta Data -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <title>BeanzCroc</title>
</head>
<body>
  <header> <!-- Header bar at top -->
    <a href="home.php"> <!-- "Logo" and link back to the home page -->
      <h1>BeanzCroc</h1>
    </a>
    <nav> <!-- Navigation buttons -->
      <ul>
        <li class="navButtons">
          <a href="settings.html">Settings</a>
        </li>
                
        <?php 
          if ($logged_in == False){
            echo "<li class='navButtons'>
            <a href='registerAccount.php'>Register</a></li>";

            echo "<li class='navButtons'>
            <a href='loginPage.php'>Login</a></li>";
          } else {
            echo "<li class='navButtons'>
            <a href='userProfile.html'>".$_SESSION["handle"]."</a></li>";

            echo "<li class='navButtons'>
            <a href='clear_session.php'>Logout</a></li>";
        }         
                    
        ?>

        <li class="navButtons">
          <a href="home.php">Home</a>
        </li>
      </ul> 
    </nav>
  </header>
  
  <!-- Starts the body for the follow page -->
  <div>
        
    <!-- The User's Handle and the Follower/Following titles at the top of the page-->
    <div> 
      <h4 id="beanzBigTitle"><?php echo $_GET["handle"]; ?></h4>
      <h3 class="colTitle colLeft">Followers</h3>
      <h3 class="colTitle colRight">Following</h3>
    </div>
        
    <!-- The Follower/Following columns div -->
    <div>
      <!-- Followers Column -->
      <div class="folCol nameListCol colLeft"> <!-- People who follow this user -->

      <!-- The folEntry divs will most likely need to be recreated in PHP in a while loop so that all followers/following users are displayed. -->
      <!-- Comment them out and then create them in PHP with the same general format. The Profile button can be ignored for now. -->
      <!-- Make sure that all IDs and classes carry over when replicating them in PHP -->

        
        <?php 
            require_once "database.php";
            $database = new Database();
            $result = $database->get_followers($_GET["handle"]);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='nameListEntry'>
                    <p class='nameListP'>".$row["follower_handle"]."</p>
                    </div>";
                }
            } else { echo "No followers"; }
        ?>

        <!-- 1 entry in the Follower column -->
        <!-- <div class="nameListEntry">
          <p class="nameListP">FollowerName</p>
          <button id="nameListProfile" class="folButton">Profile</button> we don't need this just yet
        </div> -->
      </div>
        
      <!-- Following Column -->
      <div class="folCol nameListCol colRight"> <!-- People whom this user follows-->
        <!-- 1 entry in the Following column -->
        <!-- <div class="nameListEntry">
          <p class="nameListP">FollowingName</p>
          <button id="nameListProfile" class="folButton">Profile</button> we don't need this just yet
        </div> -->

        <?php 
            require_once "database.php";
            $result = $database->get_following($_GET["handle"]);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='nameListEntry'>
                        <p class='nameListP'>".$row["following_handle"]."</p>
                        </div>";
                }
            } else { echo "Not following anyone"; }
        ?>

      </div>
    </div>
  </div>
</body>
</html>
