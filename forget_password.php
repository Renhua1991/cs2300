<?php
	session_start();
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../Downloads/finalproject/css/style.css">
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
</head>
<body>

	<!-- login part -->
	<?php  
	//no session
	if(!isset($_SESSION['logged_user'])){

		//no email, no password
		if(!isset($_POST['email']) && !isset($_POST['password']) ){
	?>

			<div class="user_login">

				<div class="left_most">
					<p>Cornell Sports Club</p>
				</div>

				<div class="left_login">
					<form action="register.php" method="post">
				        Email: <input type="text" name="email"> <br>
				        Password: <input type="password" name="password"> <br>
				        <input type="submit" value="Login" name="submit_login">
		        	</form>	
				</div>
				
				<div class="right_login">
					<form action="register.php" method="post">
			        	<input type="submit" value="Forget password" name="submit_forget_password">
			        </form>

			        <form action="register.php" method="post">
			        	<input type="submit" value="Register a new user!" name="submit_register">
			        </form>	
				</div>
		        
			</div>

	<?php 
		}

		//submit password and email 
		if(isset($_POST['email']) && isset($_POST['password']) ){
			//get email and password
			$email = (isset($_POST['email']) ? $_POST['email']: null);
	        $password = (isset($_POST['password']) ? $_POST['password']: null);
	    	//hash the password
	        $hashed_password = hash("sha256", $password);

	        //login successfully
	        $bool = login($email, $password, $mysqli);
			if($bool == true){
				header('Location:index.php');

			//failed to login
			}else{
				print("<p>Wrong email or password.</p>");
			}

		}

		//register
		if(isset($_POST['submit_register'])){
			header('Location:register.php');
		}

		//forgot password
		if(isset($_POST['submit_forget_password'])){
			header('Location:forget_password.php');
		}


	//find session 
	}else{
		$find_username = $_SESSION['logged_user'];
		//echo "<p>$find_username</p>";
	?>

		<div class="user_login">
	<?php  
		print("<p>Welcome  " .$find_username . "</p>");
	?>
			
			<form action="forget_password.php" method="post">
				<input type="submit" value="Logout" name="submit_logout">
			</form>
		</div>


	<?php  
	}
	if (isset($_POST['submit_logout'])) {
		logout();
	}
	?>




	<div class="nav">
	    <ul>
	      	<li><a href="../Downloads/finalproject/index.php">ABOUT US</a></li>
		    <li><a href="teams.php">TEAMS</a></li>
		    <li><a href="schedule.php">EVENTS</a></li>
		    <li><a href="news.php">CONTACT</a></li>
	    </ul>
	</div>


	<div class="container">
		<form action="forget_password.php" method="post">
			UserName:<input type="text" name="check_username"> <br>
	  		Email:<input type="text" name="email_forget"> <br>
	  		<input type="submit" value="Submit" name="forget_pass">
	  	</form>
	</div>


  	<?php  
  	if(isset($_POST['forget_pass'])){

  		$email_forget = $_POST['email_forget'];
		$query = "SELECT * FROM user WHERE email='$email_forget'";
		$result = $mysqli -> query($query);
		$count = mysqli_num_rows($result);
		// If the count is equal to one, we will send message other wise display an error message.
		if($count == 1){
			$rows = mysqli_fetch_array($result);

			if ($rows['user_name'] == $_POST['check_username'] ) {
				
				$pass = generateRandomPassword();
				//echo "your pass is ::".($pass)."";
				$to = $rows['email'];
				//echo "your email is ::".$email;
				//Details for sending E-mail
				$url = "http://";
				$body = "Cornell sports club password recovery "."<br/>".
				"------------------------------------------------------"."<br/>"."
				Your email address is : $to;"."<br/>"."
				Here is your password  : $pass;";

				//$from = "Your-email-address@domaindotcom";
				$subject = "Password recovered from Cornell Sports Club";
				
				$headers1 = "Content-type: text/html;charset=iso-8859-1\r\n";
				$headers1 .= "X-Priority: 1\r\n";
				$headers1 .= "X-MSMail-Priority: High\r\n";
				$headers1 .= "X-Mailer: Just My Server\r\n";

				$sentmail = mail ( $to, $subject, $body, $headers1 );

				$new_query = "UPDATE user SET password = $pass WHERE email = $to";
				$mysqli -> query($new_query);

				echo "<p>  </p>";

			} 
			// else {
			// 	if ($_POST ['email'] != "") {
			// 		echo "<span style='color: #ff0000;'> Not found your email in our database</span>";
			// 	}

			// } 
			else {
				echo "<p>username and email don't match.</p>";
			}


		}

		// //If the message is sent successfully, display sucess message otherwise display an error message.
		// if($sentmail==1){
		// 	echo "<span style='color: #ff0000;'> Your Password Has Been Sent To Your Email Address.</span>";
		// }
		// else{
		// 	if($_POST['email']!="")
		// 	echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
		// }

	}

  	?>





</body>
</html>