<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
     
    session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Cornell Sports Club Council</title>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='css/style.css' rel='stylesheet' type='text/css'>
    <link href='css/headercss.css' rel='stylesheet' type='text/css'>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
    <script src="js/javascript.js"></script>
</head>
<body>
    <?php 
    	include 'header.php'
    ?>

	<div class="container">
		<p>This is Teams page.</p>
	</div>

	<?php  
		include 'footer.php'
	?>




</body>
</html>