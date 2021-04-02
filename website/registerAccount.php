<?php 
    if( session_status() != 2 ) {
        echo "Session Status is not 2 ";
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
  <title>BeanzCroc</title>
</head>

<?php 
    require_once "database.php";
    $handle = $pass = $pass_conf = "";
    $error0 = $error1 = $error2 = $error3 = "";
    $valid = True;
    $database = new Database();


    if (isset($_POST['submit'])) {
        $handle = $_POST['handle'];
        $pass = $_POST['pass'];
        $pass_conf = $_POST['pass_conf'];
    }

    if (isset($_POST['handle']) && isset($_POST['submit'])) {
        // echo "handle is set & submit is set";
        // echo $_POST['handle'];
        if ($_POST['handle'] == "" || !preg_match("/^[a-zA-Z0-9]*$/", $handle)){ // handle is either empty or invalid
            $error1 = "Your handle must consist of alphanumeric characters only and cannot contain any spaces.";
            $valid = False;
        } else {
            $handle = $_POST['handle'];

        }
    }


    if (isset($_POST['pass']) && isset($_POST['submit'])) {
        // echo "pass is set & submit is set";
        // echo $_POST['pass'];
        if ($_POST['pass'] == "" || strlen($_POST['pass']) < 8 ) { // pass is either empty or invalid
            $error2 = "Password must be 8 or more characters.";
            $valid = False;
        } else if (!preg_match("/^[a-zA-Z0-9@#$%^&]*$/", $pass)) {
            $pass = $_POST['pass'];
            $error2 = "Password must not contain any of the following characters: ()/\[]{}<>-=+_|;:?";
            $valid = False;
        }
    }


    if (isset($_POST['pass_conf']) && isset($_POST['submit'])) {
        // echo "pass is set & submit is set";
        // echo $_POST['pass'];
        if ( !($_POST['pass_conf'] == $_POST['pass']) ) { // pass is either empty or invalid
            $error3 = "Passwords must match.";
            $valid = False;
        }
    }

    if ($valid == True && isset($_POST['submit'])) {
       $database->insert_user($handle, $pass);
       // header("Location: home.php");
    } else {
        echo " -- Input not valid. Cannot add user to DB";
    }

?>

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
    
  <!-- Starts the body for the Register Account page -->
  <h4 id="beanzBigTitle">Register Account <?php echo $error0; ?></h4>

  <!-- Starts HTML Form for the register part -->
  <form method="POST" action="registerAccount.php" class="beanzForm">
    <div id="regForm">

      <!-- User's Handle -->
      <label for="handle">Handle</label>
      <input name="handle" placeholder="Enter Handle" type="text" id="handle" value=<?php echo '"'.$handle.'"'; ?> required>
      <p class="errorMessage"><?php echo $error1; ?></p>

      <!-- User's Password -->
      <label for="pass">Password</label>
      <input name="pass" placeholder="Enter Password" type="password" id="pass" value=<?php echo '"'.$pass.'"'; ?> required>
      <p class="errorMessage"><?php echo $error2; ?></p>

      <!-- Confirm User's password -->
      <label for="pass_conf">Confirm your password</label>
      <input name="pass_conf" placeholder="Repeat Password" type="password" id="pass_conf" value=<?php echo '"'.$pass_conf.'"'; ?> required>
      <p id="errorConfirm" class="errorMessage"><?php echo $error3; ?></p>

      <!-- Submit Button -->
      <button name="submit" type="submit" class="formButton regLogButton">Register</button>
    </div>
  </form>

  <div> <!-- Link to the other page -->
    <p class="already">Already have an account?</p>  
    <a href="loginPage.php">
      <p class="altBtn">Login</p>
    </a>
  </div>

  <div>
    <?php
        // echo "<br>POSTED VALUES:<br>";
        // echo "handle: " . $handle . " " . $error1;
        // echo "<br><br>";
        // echo "pass: " . $pass . " " . $error2;
        // echo "<br><br>";
        // echo "pass_conf: " . $pass_conf . " " . $error3;
    ?>
  </div>

</body>
</html>
