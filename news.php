<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
     
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../Downloads/finalproject/css/style.css">
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
  <script src="js/javascript.js"></script>
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
					<form action="news.php" method="post">
				        Email: <input type="text" name="email"> <br>
				        Password: <input type="password" name="password"> <br>
				        <input type="submit" value="Login" name="submit_login">
		        	</form>	
				</div>
				
				<div class="right_login">
					<form action="news.php" method="post">
			        	<input type="submit" value="Forget password" name="submit_forget_password">
			        </form>

			        <form action="news.php" method="post">
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
				header('Location:news.php');

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
			
			<form action="news.php" method="post">
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
		<p>This is News page.</p>
		
	</div>





</body>
</html>