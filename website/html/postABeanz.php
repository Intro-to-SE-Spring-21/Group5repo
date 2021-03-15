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
<head> <!-- Meta Data -->
    <meta charset="utf">
    <link rel="stylesheet" href="main.css">
    <title>BeanzCroc</title>
    <!-- add links to fonts here -->
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
    <!-- Starts the body for the Post a Beanz page -->

    <h4 id="beanzBigTitle">Post a Beanz</h4>
    <div id="postBeanzForm"> <!-- The form to take input from user for Beanz -->
        <form action="recieve_tweet.php" method="POST" class="beanzForm">
            <!-- Title for the Beanz -->
            <label for="bTitle">Beanz Title:</label><br>
            <input type="text" placeholder="Enter Beanz Title" name="bTitle" size="30" maxlength="50" id="bTitleInput" required><br>

            <!-- Actual text for the Beanz -->
            <label for="bText">Beanz Text:</label><br>
            <textarea name="bText" placeholder="Enter Beanz Test" rows="5" cols="26" minlength="1" maxlength="140" required></textarea><br>
            
            <!-- Submit and Clear buttons -->
            <input type="submit"  id="beanzSubmit" name="bSubmit" value=
            <?php 
                if (isset($_SESSION['handle'])) {
                    // echo "'Submit' name='submit'";
                    echo "'".$_SESSION['handle']."'";
                } else {
                    echo "'Sign in to submit' disabled";
                }
                

            ?> >
            <input type="reset" value="Clear" id="beanzClear">
        </form>
    </div>
    

</body>
</html>
