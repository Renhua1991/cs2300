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
  <script src="js/javascript.js"></script>
</head>
<body>

	<?php  
		include 'menu.php'
	?>


	<div class="register">
		<form action="register.php" method="post">
			Email: <input type="text" name="email_register"> <br>
			User Name: <input type="text" name="username_register"> <br>
	        Password: <input type="password" name="password_register"> <br>
	        <input type="submit" value="Submit" name="submit_register">
		</form>
	</div>


	<?php  
		//register
		if(isset($_POST['email_register']) && isset($_POST['username_register']) && isset($_POST['password_register']) ){
			//get information to register
			$email_register = (isset($_POST['email_register']) ? $_POST['email_register']: null);
			$username_register = (isset($_POST['username_register']) ? $_POST['username_register']: null);
	        $password_register = (isset($_POST['password_register']) ? $_POST['password_register']: null);
	        $hashed_password_register = hash("sha256", $password_register);

	        register($email_register, $username_register, $hashed_password_register);

		}
	?>

	<?php  
		include 'footer.php'
	?>

</body>
</html>