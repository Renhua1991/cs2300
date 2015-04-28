<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
     
    session_start(); 
    include 'menu.php'
?>

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
                <form action="admin.php" method="post">
                    Email: <input type="text" name="email"> <br>
                    Password: <input type="password" name="password"> <br>
                    <input type="submit" value="Login" name="submit_login">
                </form>
            </div>

            <div class="right_login">
                <form action="admin.php" method="post">
                    <input type="submit" value="Forget password" name="submit_forget_password">
                </form>

                <form action="admin.php" method="post">
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

        <form action="admin.php" method="post">
            <input type="submit" value="Logout" name="submit_logout">
        </form>
    </div>


<?php
}
if (isset($_POST['submit_logout'])) {
    logout();
}
?>