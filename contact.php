<?php 
    include 'menu.php'
?>
<div id="contact">
    <h1>CONTACT US</h1>
    <?php
    //if "email" variable is filled out, send email
    if (isset($_REQUEST['email']))  {

        //Email information
        $admin_email = "mz234@cornell.edu";
        $email = $_REQUEST['email'];
        $subject = $_REQUEST['subject'];
        $comment = $_REQUEST['comment'];

        //send email
        mail($admin_email, "$subject", $comment, "From:" . $email);

        //Email response
        echo "Thank you for contacting us!";
    }

    //if "email" variable is not filled out, display the form
    else  {
        ?>

        <form method="post">
            Email: <input name="email" type="text" required=""/><br />
            Name: <input name="subject" type="text" /><br />
            Message:<br />
            <textarea name="comment" rows="15" cols="40"></textarea><br />
            <input type="submit" value="Submit" />
        </form>

    <?php
    }
    ?>

    </div>
<?php 
    include 'footer.php'
?>