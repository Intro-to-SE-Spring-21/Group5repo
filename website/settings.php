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
        header("Location: loginPage.php");
    }
?>

<!DOCTYPE html>
<html lang="en-us">
<head> <!-- Meta Data -->
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

  <!-- Starts the body for the settings page -->
  <div>
        
    <!-- The User's Handle and the Bio titles at the top of the page-->
    <div> 
      <h4 id="beanzBigTitle">Settings</h4>
      <h3 class="colTitle colLeft">Bio</h3>
      <h3 class="colTitle colRight">Username</h3>
    </div>
        
    <!-- The Username/Bio columns div -->
    <div id="settColWhole">

      <!-- Bio Column -->
      <div class="settCol colLeft"> <!-- Edit Bio Column -->
        <form action="placeholder_bio.php" method="POST" class="settForm">
          <!-- Edit Bio Form -->
          <label for="bioText">Edit your Bio:</label><br>
          <textarea name="bioText" placeholder="Enter new bio" rows="5" cols="26" minlength="1" maxlength="70" required></textarea><br>
                    
          <!-- Submit and Clear buttons -->
          <input name="bioSubmit" type="submit" class="formButton" id="bioSubmit" value="Submit">
          <input type="reset" class="formButton" id="bioClear" value="Clear">
        </form>
      </div>
            
      <!-- Username Column -->
      <div class="settCol colRight"> <!-- Edit Username Column -->
        <form action="placeholder_username.php" method="POST" class="settForm">
          <!-- Edit Username Form -->
          <label for="settUser">Edit your username:</label><br>
          <input name="settUser" placeholder="Enter new username" type="text" id="settUserInput" size="30" minlength="1" maxlength="20" required><br>
        
          <!-- Submit and Clear buttons -->
          <input name="userSubmit" type="submit" class="formButton" id="userSubmit" value="Submit">
          <input type="reset" class="formButton" id="userClear" value="Clear">
        </form>
      </div>
    </div>
  </div>

</body>
</html>
