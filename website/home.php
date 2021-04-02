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
    $viewProfErr = "";
    $viewFollowsErr = "";
    $followErr = "";
    $tid = "";
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    function isFollowing(handle) {
      var xhttp;
      if (handle == "") {
        // document.getElementById("txtHint").innerHTML = "";
        console.log("Cannot check own followers without logging in.");
        return;
      }
      xhttp = new XMLHttpRequest();
      output = false;
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        // document.getElementById("txtHint").innerHTML = this.responseText;
            // console.log(this.responseText);
            console.log("Already following user.");
            // return(this.responseText);
            output = this.responseText;
            if(output == "true"){
                document.getElementById("followErr").innerHTML = "You are already following this user.";
                return true;
            } else {
                console.log("Not following this user.");
            }
            // document.getElementById("FollowButton").innerHTML = "Follow this User";

        }
        // document.getElementById("FollowButton").innerHTML = "Follow this User";

      };
      xhttp.open("GET", "is_following.php?handle="+handle, true);
      xhttp.send();
    }

    function clearErrors(){
        document.getElementById("followErr").innerHTML = "";
        // document.getElementById("FollowButton").innerHTML = "Follow this User";

    }
    // Tell this code to only run once the page is fully loaded.
    $(document).ready(function(){
            var likesCount = 8;
            var tid = 0;
            var postHandle = "";
            var loggedInUser = '<?php 
                    if (isset($_SESSION["handle"])) {
                        echo $_SESSION["handle"];
                    } else {
                        echo "";
                    }

                ?>';

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
                clearErrors();
                if (loggedInUser != ""){
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
                } else {
                    alert("Please sign in or make an account before liking tweets");
                }
            });

            $("#ViewFollowButton").click(function(){
                clearErrors();
                postHandle = $("#mainUserHandle").html();
                postHandle.toString();
                // console.log(postHandle);
                // Simulate a mouse click:
                window.location.href = "follow.php?handle="+postHandle;
            });


            $("#FollowButton").click(function(){
                clearErrors();
                
                var xhttp2 = new XMLHttpRequest();
                postHandle = $("#mainUserHandle").html();
                postHandle.toString();
                loggedInUser = '<?php 
                    if (isset($_SESSION["handle"])) {
                        echo $_SESSION["handle"];
                    } else {
                        echo "";
                    }

                ?>';

                if (loggedInUser == ""){
                    alert("Please log in to follow a user.");
                } else if (postHandle == "Handle Here") {
                    alert("Can't follow a non-existent user. Try clicking a post before attempting to follow a user.");
                } else {
                    if (isFollowing(postHandle) == true) {
                        console.log("Hello there!"); // can't get this to run no matter what I try...
                    }
                    // console.log(loggedInUser, postHandle);
                    // We will do this to make it harder for a user to follow themselves... Still not impossible though.
                    if (loggedInUser != postHandle) {
                        xhttp2.open("GET", "follow_user.php?following="+postHandle, false);
                        xhttp2.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                                console.log(this.responseText); // results of SQL insert
                            }
                        };

                    // xhttp.open("GET", "is_following.php?following="+postHanle, true);
                        xhttp2.send("handle_follower="+loggedInUser+"&"+"handle_following="+postHandle); // NOTE: ANYONE CAN MAKE ANY USER FOLLOW ANY OTHER USER. WE SHOULD REQUIRE A PASSWORD OR SOMETHING.
                        var results = xhttp2.responseText;

                        // $("#FollowButton").load("follow_user.php", {
                        //     follower: loggedInUser,
                        //     following: postHandle
                        // });
                        // console.log(results);

                    } else {
                        document.getElementById("followErr").innerHTML = "You cannot follow yourself.";

                    }
                    // window.location.href = "follow.php?handle="+postHandle;
                }
                // console.log(loggedInUser  + " " + postHandle);


                // postHandle.toString();
                // console.log(postHandle);
                // // Simulate a mouse click:
                // window.location.href = "follow.php?handle="+postHandle;
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

  <!-- Post a Beanz / Feed -->
  <div id="leftCol" class="col">
    <a href="postABeanz.php" id="postBeanz"> Post a Beanz </a>

      <div>
        <h3 id="feedTitle">Feed</h3>
      </div>

      <div class="feed">
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
                    .$row["tid"]. ", '" .$row["tweet_title"]. "','" .str_replace("'", "\'", $row["content"]). "','" . $row["handle"]. "','" .$row["handle"] ."')\">"     // DATA FROM HERE  "','".$row["total_likes"].
                    . $row["tweet_title"] 
                    . "</p>";
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
    <p class="beanzTitle" id="mainBTitle">The Beanz Title will appear here!</p>
    <p class="beanzText" id="mainBText">Please select a Beanz on the left. The Beanz Text will appear here!</p>
    <button hidden id="likeButton" hidden>Like this Beanz</button>
    <a id="likesList" href="likesList.php?tweet_id=''">
      <p hidden id="likeCount">0</p>
    </a>
  </div>

  <!-- User info -->
  <div id="userInfo" class="col">
    <p class="colUser" id="mainUserName">Username Here</p>
    <p class="colHandle" id="mainUserHandle">Handle Here</p>
    <button id="viewProfErr" hidden>View User Profile</button>
    <p id="errorMsg" class="errorMessage"><?php echo "".$viewProfErr."" ?></p>
    <button id="ViewFollowButton" hidden>View Follows</button>
    <p id="viewFollowsErr" class="errorMessage"><?php echo "".$viewFollowsErr."" ?></p>
    <button id="FollowButton" hidden>Follow this User</button>
    <p id="followErr" class="errorMessage"><?php echo "".$followErr."" ?></p>
  </div>

</body>
</html>


<script>
    function display_tweet(tweet_id, tweet_title, content, handle, username) {
        clearErrors();
        console.log(content);

        // Remove disabled attributes from buttons now that we have a real tweet selected.
        document.getElementById('likeButton').hidden = false;
        document.getElementById('viewProfErr').hidden = false;
        document.getElementById('ViewFollowButton').hidden = false;
        document.getElementById('FollowButton').hidden = false;
        document.getElementById('likeCount').hidden = false;

        document.getElementById('tweetID').innerHTML = tweet_id;
        var tid = $("#tweetID").html();
        document.getElementById('likesList').href = "likesList.php?tweet_id="+tid+"&title="+tweet_title;
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

        document.getElementById('mainUserName').innerHTML = handle;
        document.getElementById('mainUserHandle').innerHTML = username;

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
