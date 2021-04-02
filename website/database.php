<?php
	
	class Database {
		
		private $hn;
		private $un;
		private $pw;
		private $db;
		private $port;
		public function __construct(){
			require_once "login.php";
			$this->hn = $hn;
			$this->un = $un; 
			$this->pw = $pw; 
			$this->db = $db;
			$this->port = $port;
			// echo $this->hn . " " . $this->un . " " . $this->pw . " " . $this->db;
		}

		public function insert_user($handle, $password){
			$conn = new mysqli($this->hn, $this->un, $this->pw, $this->db, $this->port);
			if ($conn->connect_error){
				echo " ded.";
				die($conn->connect_error);
			}

			$insert_query = "INSERT INTO users VALUES('".$handle."', '".$handle."', '".$password."');"; // ADD BACK IN BIO AFTER UPDATING THE DB
			//mysqli_query($conn, $query);
		    if(mysqli_query($conn, $insert_query)){
		    	echo "Records inserted successfully.<br>";
			} else {
			    echo "ERROR: Could not execute $insert_query <br>" . mysqli_error($conn);
			}

		    // $result = $conn->query("SELECT * from tweets");
		    // if($result->num_rows > 0) {
			   //  while($row = $result->fetch_assoc()){
			   //      echo $row["tweet_title"] . " - " . $row["content"] . " - " . $row["tid"] . " - " . $row["date_posted"] . "<br>";
			   //  }
		    // } else { echo "No tweets found in table."; }
		    // echo $_POST['bTitle'];
		    // echo "<br>";
		    // echo $_POST['bText'];


		    // Close the connection when we're done
		    $conn->close();
		}

		public function validate_creds($handle, $password){
			$conn = new mysqli($this->hn, $this->un, $this->pw, $this->db, $this->port);
			$credentials_valid = False;

			if ($conn->connect_error){
				echo " ded.";
				die($conn->connect_error);
			}

			$result = $conn->query("SELECT * from users WHERE handle='".$handle."'");
		    if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()){
			        // echo $row["handle"] . " - " . $row["username"] . " - " . $row["password"]. "<br>";
			        if ($row["handle"] == $handle && $row["password"] == $password) {
			        	$credentials_valid = True;
			        }
			    }
		    } //else { echo "No user found: ".$handle; }
		    return($credentials_valid);
		}





		public function get_followers($handle){
			$conn = new mysqli($this->hn, $this->un, $this->pw, $this->db, $this->port);

			if ($conn->connect_error){
				echo " ded.";
				die($conn->connect_error);
			}

			$result = $conn->query("SELECT * from follow WHERE following_handle='".$handle."'");
			// echo $result;
		    
		    return($result);
		}


		public function get_following($handle){
			$conn = new mysqli($this->hn, $this->un, $this->pw, $this->db, $this->port);

			if ($conn->connect_error){
				echo " ded.";
				die($conn->connect_error);
			}

			$result = $conn->query("SELECT * from follow WHERE follower_handle='".$handle."'");
			// echo $result;
		    
		    return($result);
		}



		public function follow_user($handle_follower, $handle_following){
			$conn = new mysqli($this->hn, $this->un, $this->pw, $this->db, $this->port);

			if ($conn->connect_error){
				echo " ded.";
				die($conn->connect_error);
			}
			echo "Follow user is running.";

			$insert_query = "INSERT INTO follow VALUES('".$handle_follower."', '".$handle_following."');";
		    
		    if(mysqli_query($conn, $insert_query)) {
		    	echo "Records inserted successfully.<br>";
			} else {
			    echo "ERROR: Could not execute $insert_query <br>" . mysqli_error($conn);
			}

		}

		public function like_tweet($tweet_id, $handle, $increment){
			$conn = new mysqli($this->hn, $this->un, $this->pw, $this->db, $this->port);
			// echo $increment;
			if ($conn->connect_error){
				echo " ded.";
				die($conn->connect_error);
			}
			// echo "Like tweet is running.";
			if ($increment == 'true'){
				$insert_query = "INSERT INTO likes_a VALUES('".$tweet_id."', '".$handle."');";
			    
			    if(mysqli_query($conn, $insert_query)) {
			    	echo "Liked tweet<br>";
				} else {
				    // echo "ERROR: Could not execute $insert_query <br>" . mysqli_error($conn);
				}
			}


			// $update = "UPDATE `tweets` SET `total_likes` = '" . ($current_likes+1) . "' WHERE `tweets`.`tid` = " . $tid . ";";
			// if(mysqli_query($conn, $update)){
	  //   		echo ("Hiya!");
			// }

			// $result = mysqli_query($conn, "SELECT COUNT('tid') from likes_a WHERE tid='".$tweet_id."'");
			// echo "likes: " . $result;
		    $result=mysqli_query($conn, "SELECT COUNT(*) FROM likes_a WHERE tid='".$tweet_id."'");
			$row=mysqli_fetch_assoc($result);
			echo $row["COUNT(*)"];
		    // return($result);

		}

	// 	public function test_func($TestText){
	// 		echo $TestText . "<br>";
	// 	}

	// 	public function create_table($Title){
	// 		// Select proper table, so we can query for data
	// 		echo "Might not use this.";
	// }

	}
?>