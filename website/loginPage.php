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
  <title>BeanzCroc</title>
</head>


<?php 
    require_once "database.php";


    $handle = $pass = $pass_conf = "";
    $error0 = "";
    $valid = False;
    $database = new Database();

    if (isset($_POST['submit'])) {
        $handle = $_POST['handle'];
        $pass = $_POST['password'];
    }

    if (isset($_POST['handle']) && isset($_POST['submit']) && isset($_POST['password'])) {
        // echo "handle is set & submit is set";
        // echo $_POST['handle'];
        $valid = True;
    }

    if ($valid == True && isset($_POST['submit'])) {
       $creds_validated = $database->validate_creds($handle, $pass);
       $error0 = "";
        if ($creds_validated){
            // echo "<br>Valid credentials entered.";
            $_SESSION["password"] = $pass;
            $_SESSION["handle"] = $handle;
            header("Location: home.php");

        } else {
            $error0 = "<br>Invalid credentials entered.";
        }
        // header("Location: home.php");
    }


        // if (isset($_SESSION["handle"])){
        //     // echo $_SESSION["handle"];
        // } else {
        //     // echo "Username is not set.";
        // }

?>


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

  <!-- Starts the body for the Login page -->

  <h4 id="beanzBigTitle">Login to Account</h4>
    
  <!-- Starts HTML Form for the login part -->
  <form method="POST" id="login-form" action="loginPage.php" class="beanzForm">
    <div id="loginForm">
      
      <!-- User's handle -->
      <label for="handle">Handle</label>
      <input name="handle" placeholder="Enter Handle" type="text" class="login-form-field" id="username-field" value=<?php echo "'".$handle."'" ?> >

      <!-- User's password -->
      <label for="psw">Password</label>
      <input name="password" placeholder="Enter Password" type="password" class="login-form-field" id="password-field">
      <p id="errorMsg" class="errorMessage"><?php echo "".$error0."" ?></p>

      <!-- Submit Button-->
      <input name="submit" type="submit" class="formButton regLogButton" id="login-form-submit" value="Login">
    </div>
  </form>

  <div> <!-- Link to the other page -->
    <p class="already">Don't have an account?</p>  
    <a href="registerAccount.php">
      <p class="altBtn">Register</p>
    </a>
  </div>

</body>
</html>
