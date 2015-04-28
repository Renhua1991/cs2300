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

<div id="content">
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

            <form action="index.php" method="post">
                <input type="submit" value="Logout" name="submit_logout">
            </form>
        </div>


    <?php
    }
    if (isset($_POST['submit_logout'])) {
        logout();
    }
    ?>
    <header>
        <div class="fix">
            <nav id="navigation" class="site-navigation" role="navigation">
                <ul class="menu">
                    <li><img src="img/logo.png" alt="" id="logo" align="middle"></li>
                    <li class="menu-item"><a href="#">About Us</a></li>
                    <li class="menu-item"><a href="#">Teams</a>
                        <div class="dropdown">
                            <ul>
                                <li class="sub-menu"><a href="#">Team 1</a></li>
                                <li class="sub-menu"><a href="#">Team 2</a></li>
                                <li class="sub-menu"><a href="#">Team 3</a></li>

                            </ul></div></li>

                    <li class="menu-item"><a href="events.php">Events</a></li>
                    <li class="menu-item"><a href="contact.php">Contact</a></li>
                    <li class="menu-item"><a href="#">Admin</a></li>

                </ul>
                <form id="search" method="post" action="index.php">
                    <input type="search" name="filter" results="5" value="" />
                    <input type="submit" value="Search" />
                </form>
            </nav>
        </div>
        <h1></h1>

    </header>
    <div class="content-main-body">
    <div class="content-main">

    <div class="content-main-links">
        <a href=""><img src="http://assets.sdes.ucf.edu/images/icons/facebook.png" alt="Facebook" title="Facebook"></a>
    </div>
    <div><h1>Welcome!</h1>


    <div class="upperleft">
        <p>Introductions go here</p>

        <ul class="link-list bullets">
            <li><a href="#">Sport Club Council Executive Board Members</a></li>
            <li><a href="#">Sport Club Supervisors</a></li>
        </ul>
    </div>

        <div class="left">
            <h2>Schedule</h2>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Mauris ante ligula, facilisis sed ornare eu, lobortis in odio. Praesent convallis urna a lacus interdum ut hendrerit risus congue. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta. Cras ac leo purus. Mauris quis diam velit.
        </div>

    <div class="right">
    <h2>Highlights</h2>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Mauris ante ligula, facilisis sed ornare eu, lobortis in odio. Praesent convallis urna a lacus interdum ut hendrerit risus congue. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta. Cras ac leo purus. Mauris quis diam velit.
    </div>
    </div>



    </div>

    </div>

</div>
<?php include 'footer.php'?>
</body>
</html>