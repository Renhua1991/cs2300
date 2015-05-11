<?php 
    include 'menu.php'
?>
    <!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Cornell Sports Club Council</title>
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/main.js"></script> <!-- Resource jQuery -->
    <link rel="stylesheet" href="css/contact.css"> <!-- Resource style -->
</head>
<div id="contact">
    <h1>CONTACT US</h1>
    <?php
    //if "email" variable is filled out, send email
    if (isset($_REQUEST['cd-email']))  {
        //Email information
        $admin_email = "mz234@cornell.edu";
        $email = $_REQUEST['cd-email'];
        $subject = $_REQUEST['cd-name'];
        $comment = $_REQUEST['cd-textarea'];

        //send email
        mail($admin_email, "$subject", $comment, "From:" . $email);

        //Email response
        echo "Thank you for contacting us!";
    }

    //if "email" variable is not filled out, display the form
    else  {
        ?>

        <form method="post" class="cd-form floating-labels">

            <div class="error-message">
                <p>Please enter a valid email address</p>
            </div>

            <div class="icon">
                <label class="cd-label" for="cd-name">Name</label>
                <input class="user" type="text" name="cd-name" id="cd-name" required>
            </div>

            <div class="icon">
                <label class="cd-label" for="cd-email">Email</label>
                <input class="email error" type="email" name="cd-email" id="cd-email" required>
            </div>


            <div class="icon">
                <label class="cd-label" for="cd-textarea">Your message</label>
                <textarea class="message" name="cd-textarea" id="cd-textarea" required></textarea>
            </div>

            <div>
                <input type="submit" value="Send Message">
            </div>
        </form>




    <?php
    }
    ?>

    </div>

<?php 
    include 'footer.php'
?>