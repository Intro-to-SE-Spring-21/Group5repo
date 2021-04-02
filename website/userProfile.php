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
<html lang="en-us">
<head> <!-- Meta Data -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
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
          <a 
          <?php 
            if (!$logged_in){
                echo "hidden ";
            }
          ?>
          href="settings.php">Settings</a>
        </li>

        <?php 
            if ($logged_in == False){
                echo "<li class='navButtons'>
                    <a href='registerAccount.php'>Register</a></li>";

                echo "<li class='navButtons'>
                    <a href='loginPage.php'>Login</a></li>";
            } else {
                echo "<li class='navButtons'>
                    <a href='userProfile.php'>".$_SESSION["handle"]."</a></li>";

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
  <!-- Starts the body for the home page -->


  <!-- User info -->
  <div id="profileInfo" class="col">
    <p class="colUser" id="profileUserName">Username Here</p>
    <p class="colHandle" id="profileHandle">Handle Here</p>

    <p id="userBio">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    
    <button id="ViewFollowButton">View Follows</button>
    <button id="FollowButton">Follow this User</button>
  </div>
  
  <!-- Beanz full message -->
  <div id="profileBeanz" class="col">
    <p id="tweetID" hidden>tid_here</p>
    <p class="beanzTitle" id="profileBTitle">The Beanz Title will appear here!</p>
    <p class="beanzText" id="profileBText">Please select a Beanz on the right. The Beanz Text will appear here!</p>
    <button id="likeButton">Like this Beanz</button>
    <a href="likesList.php">
      <p id="likeCount">0</p>
    </a>
  </div>

  <!-- Post a Beanz / Feed -->
  <div id="rightCol" class="col">
      <div>
        <h3 id="profileFeedTitle">Feed</h3>
      </div>

      <div class="feed" id="profileFeed">
        <p id="profileTweet">Insert Tweet Info Here</p>
            
      </div>
  </div>

</body>
</html>