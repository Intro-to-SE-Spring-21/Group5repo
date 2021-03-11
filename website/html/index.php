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
            <p>Feed and stuff here</p>
        </div>
    </div>
    


    <!-- Beanz full message -->
    <div id="fullBeanz" class="col">
        <p>Beanz Title</p>
    </div>

    <!-- User info -->
    <div id="userInfo" class="col">
        <p>User Handle</p>
    </div>

</body>
</html>
