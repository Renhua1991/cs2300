<?php  
	include 'includes/db_connect.php';


	function login($email, $password, $mysqli) {
		
	    // Using prepared statements means that SQL injection is not possible. 
	    if ($stmt = $mysqli->prepare("SELECT user_id, user_name, password FROM user WHERE email = ? LIMIT 1")) {
	        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
	        $stmt->execute();    // Execute the prepared query.
	        $stmt->store_result();
	 	
	        // get variables from result.
	        $stmt->bind_result($user_id, $username, $db_password);
	        $stmt->fetch();
	 
	        // hash the password with the unique salt.
	        $password = hash('sha256', $password);
	        if ($stmt->num_rows == 1) {
	            // If the user exists we check if the account is locked
	            // from too many login attempts 
	 			
	            if (checkbrute($user_id, $mysqli) == true) {
	                // Account is locked 
	                // Send an email to user saying their account is locked
	                echo "<p>!!!!!!</p>";
	                echo "<p>Wait two hours.</p>";

	                return false;
	            } else {
	                // Check if the password in the database matches
	                // the password the user submitted.
	                if ($db_password == $password) {
	                    // Password is correct!
	                    // Get the user-agent string of the user.
	                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
	                    // XSS protection as we might print this value
	                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
	                    $_SESSION['user_id'] = $user_id;
	                    // XSS protection as we might print this value
	                    //$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
	                    $_SESSION['username'] = $username;
	                    $_SESSION['logged_user'] = $username;
	                    $_SESSION['email'] = $email;
	                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);

	                    echo "<p>======</p>";

	                    // Login successful.
	                    return true;

	                } else {
	                    // Password is not correct
	                    // We record this attempt in the database
	                	echo "<p>?????????</p>";

	                    $now = time();
	                    echo "$now";
	                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
	                                    VALUES ('$user_id', '$now')");
	                    return false;
	                }
	            }
	        } else {
	            // No user exists.
	            return false;
	        }
	    }
	}


	function checkbrute($user_id, $mysqli) {
	    // Get timestamp of current time 
	    $now = time();
	 
	    // All login attempts are counted from the past 2 hours. 
	    $valid_attempts = $now - (2 * 60 * 60);
	 
	    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
	        $stmt->bind_param('i', $user_id);
	 
	        // Execute the prepared query. 
	        $stmt->execute();
	        $stmt->store_result();
	 
	        // If there have been more than 5 failed logins 
	        if ($stmt->num_rows > 5) {
	            return true;
	        } else {
	            return false;
	        }
	    }
	}


	function register($email, $username, $password){
		require_once 'includes/config.php';
  		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$stmt = $mysqli->prepare("INSERT INTO user VALUES (NULL, ?, ?, ?, 1)");
		$stmt -> bind_param("sss", $email, $username, $password);
		$stmt -> execute();
	}


	function logout(){
		unset($_SESSION["logged_user"]);  
        header("Location: index.php");
	}


	function generateRandomPassword() {
		$length = rand(7,12);
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}


?>

