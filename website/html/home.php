<!DOCTYPE html>
<html>
<head> <!-- Meta Data -->
    <meta charset="utf">
    <link rel="stylesheet" href="main.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
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
                <li class="navButtons">
                    <a href="registerAccount.html">Register</a>
                </li>
                <li class="navButtons">
                    <a href="loginPage.html">Login</a>
                </li>
                <li class="navButtons">
                    <a href="home.php">Home</a>
                </li>
            </ul> 
        </nav>
    </header>
    <!-- Starts the body for the home page -->

    <!-- Post a Beanz / Feed -->
    <div id="leftCol" class="col">
        <a href="postABeanz.html" id="postBeanz">
            Post a Beanz
        </a>
        <div id="feed">
            <p>Feed and stuff here</p><br>
            <!-- < class='leftColumnTitle'> First Tweet <br> -->
            
            <?php
                // Add this before trying to access database contents
                require_once 'anon_login.php';
                $conn = new mysqli($hn, $un, $pw, $db, $port);

                if ($conn->connect_error) {
                    die('Connect Error (' . $conn->connect_errno . ') '
                            . $conn->connect_error);
                }

                // echo 'Connection OK '. $conn->host_info.'<br>';
                // echo 'Server '.$conn->server_info.'<br>';
                // echo 'Initial charset: '.$conn->character_set_name().'<br>';


                $result = $conn->query("SELECT * from testtweets");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<p>" . $row["title"] . "</p><br>";
                    }
                } else { echo "No tweets found in table."; }

                // Close the connection when we're done
                $conn->close();
            ?>
            
        </div>
    </div>
    


    <!-- Beanz full message -->
    <div id="fullBeanz" class="col">
        <p id="mainBTitle">Beanz Title Goes Here. 50 char limit</p>
        <p id="mainBText">Beanz Text Goes Here. 140 char limit</p>
        <button id="likeButton">Like this Beanz</button>
    </div>

    <!-- User info -->
    <div id="userInfo" class="col">
        <p>User Handle</p>
    </div>

</body>
</html>
