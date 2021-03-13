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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        
        // Tell this code to only run once the page is fully loaded.
        $(document).ready(function(){
            var likesCount = 8;
            var tid = 0;

            // Find out what our current amount of likes is for the current post.
            // $.ajax({
            //     type: "POST",
            //     url: "get_likes.php",
            //     datatype: "text",
            //     data: ({tid: 2}),
            //     success: function(likes) {
            //         likesCount = likes;
            //         $("#likeCount").load(likesCount); // set like count element to whatever current like count is
            //         console.log(likesCount);
            //     }
            // });
            
            // This triggers when you click the like button
            $("#likeButton").click(function(){
                likesCount = likesCount + 1;
                // console.log(likesCount)
                tid = $("#tweetID").html(); // this data is what we POST to like_comment.php, so it knows which tweet to increment likes on
                // console.log(tid)
                tid.toString();
                // console.log(tid)
                // updates both the database(see php code) and our HTML(see documentation for .load function) total like values
                $("#likeCount").load("like_comment.php", {
                    tweet_id: tid,
                    increment: true
                }); // set likeCount element to whatever our new like count is
            });

            


        });
    </script>
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
            <!-- < class='leftColumnTitle'> First Tweet <br> -->
            
            <?php
                // Add this before trying to access database contents
                require_once 'login.php';
                $conn = new mysqli($hn, $un, $pw, $db, $port);

                if ($conn->connect_error) {
                    die('Connect Error (' . $conn->connect_errno . ') '
                            . $conn->connect_error);
                }

                // echo 'Connection OK '. $conn->host_info.'<br>';
                // echo 'Server '.$conn->server_info.'<br>';
                // echo 'Initial charset: '.$conn->character_set_name().'<br>';


                $result = $conn->query("SELECT * from tweets");



                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<p id='".$row["tid"]
                        ."' onclick=\"display_tweet("
                        .$row["tid"]. ", '" .$row["tweet_title"]. "','" .$row["content"]."')\">"     // DATA FROM HERE  "','".$row["total_likes"].
                        . $row["tweet_title"] 
                        . "</p><br>";
                        echo "<script></script>";
                    }
                } else { echo "No tweets found in table."; }

                $conn->close(); // Close the connection when we're done
            ?>
            
        </div>
    </div>
    


    <!-- Beanz full message -->
    <div id="fullBeanz" class="col">
        <p id="tweetID" hidden>tid_here</p>
        <p id="mainBTitle">Beanz Title Goes Here. 50 char limit</p>
        <p id="mainBText">Beanz Text Goes Here. 140 char limit</p>
        <button id="likeButton" >Like this Beanz</button>
        <p id="likeCount">0</p>
    </div>

    <!-- User info -->
    <div id="userInfo" class="col">
        <p id="mainUserName">UserNameHere</p>
        <p id="mainUserHandle">UserHandleHere</p>
        <button id="FollowButton">Follow this User</button>
    </div>
 
</body>
</html>



<script>
    function display_tweet(tweet_id, tweet_title, content) {
        document.getElementById('tweetID').innerHTML = tweet_id;
        var tid = $("#tweetID").html();
        // $("#mainBTitle").load("get_tweet.php", {
        //     tweet_id: tid,
        //     column: "tweet_title"
        // }); // set main Title element to whatever our new like count is
        document.getElementById('mainBTitle').innerHTML = tweet_title;

        // $("#mainBText").load("get_tweet.php", {
        //     tweet_id: tid,
        //     column: "content"
        // }); // set likeCount element to whatever our new like count is
        document.getElementById('mainBText').innerHTML = content;

        // $("#likeCount").load("get_tweet.php", {
        //     tweet_id: tid,
        //     column: "total_likes"
        // }); // set likeCount element to whatever our new like count is
        $("#likeCount").load("like_comment.php", {
                tweet_id: tid,
                increment: false
        }); 

    }

</script>
