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
    <link href='css/team.css' rel='stylesheet' type='text/css' media="all">
    <link href='css/headercss.css' rel='stylesheet' type='text/css'>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
</head>
<body>

    <?php 
    	include 'menu.php'
    ?>

	<div class="navcontainer">
		<a href="#team1" class="button hvr-shutter-out-vertical">Women's Soccer</a>
        <a href="#team2" class="button hvr-shutter-out-vertical">Men's Fencing</a>
        <a href="#team3" class="button hvr-shutter-out-vertical">Baseball</a>
	</div>
<div id="main">
<div id="team1" class="team">
    <a name="team1"></a>
    <h1>Women's Soccer</h1>
    Cornell Women's Club Soccer was started in 2000-2001 by an excited bunch of girls looking to play 
    competitive soccer without the time commitment required of a varsity team. The first tryouts were hosted for the 2001-2002 season. 
    Since the beginning, our team has continued to improve and has had a lot of fun along the way.

</div>
    <div id="team2" class="team">
        <a name="team2"></a>
        <h1>Men's Fencing </h1>
        The Men’s Fencing Team is a competitive traveling club team, and the non-varsity counterpart to the women’s varsity fencing team at Cornell. We practice in a new, state of the art facility, the Andrew P. Stifel Fencing Salle. It was donated by former Men’s Foil Captain Andrew P. Stifel ‘91 and former Women’s fencer Nina Farouk ‘97. The Men’s Team has a full schedule of individual and team meets. The Fall schedule includes two open tournaments, the Temple Open and the Garrett Open at Penn State. 
        In addition, we customarily fence our first regular season MACFA meet in the Fall Semester, as well as any other invitationals that are scheduled. 
        In the Spring, we fence the remaining MACFA meets, the MACFA championship event, and the USACFC Club Championships (a tournament of club programs from across the country). 
        Club members also commonly attend USFA events including NACs, Junior Olympics and other local and regional events.

    </div>
    <div id="team3" class="team">
        <a name="team3"></a>
        <h1>Men's Baseball</h1>
        Cornell Club Baseball is about having a good time, meeting a lot of great guys, and, of course, playing baseball. The team practices two to three times a week, and plays competitive games on weekends. 
        A member of NCBA's North-Atlantic West division, the team competes every week for a division title and a chance to advance to the National Club Baseball World Series. 


    </div>

</div>
	<?php  
		include 'footer.php'
	?>




</body>
</html>