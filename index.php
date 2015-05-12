<?php
    session_start(); 
    require_once 'includes/config.php';
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
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

<div id="content">

    <?php 
        include 'header.php'
    ?>
    <div class="content-main-body">
    <div class="content-main">


    <div><h1>Welcome!</h1></div>


    <div class="upperleft">
        <p>Introductions go here</p>

        <ul class="link-list bullets">
            <li><a href="javascript:void(0)" onclick="$('#panel-member').slideToggle('slow');">Sport Club Council Executive Board Members</a></li>
            <li id="panel-member"><ul>
                    <li>Alexa Goldstein, President</li>
                    <li>Cody Bertolo, VP of Communications</li>
                    <li>Zachary Landzberg, Treasurer</li>
            </ul></li>
            <li><a href="javascript:void(0)" onclick="$('#panel-supervisor').slideToggle('slow');">Sport Club Teams</a></li>
            <li id="panel-supervisor"><ul>
                    <li>Archery</li>
                    <li>Baseball</li>
                    <li>Basketball</li>
                    <li>Bowling</li>
                    <li>Cheerleading</li>
                    <li>Equestriann</li>
                    <li>Field Hockey</li>
                    <li>Fencing</li>
                </ul></li>
        </ul>
    </div>

        <div class="left">
            <h2>Schedule</h2>
            Individual team's schedules can be found on specific team pages by clicking on the teams tab!
        </div>

    <div class="right">
    <h2>Highlights</h2>
        <ul class="link-list bullets">
            <li><a href="javascript:void(0)" onclick="$('#panel-detail-1').slideToggle('slow');">Highlight 1</a></li>
            <li id="panel-detail-1"> Cornell Club Basketball has won the 2015 National Championship!</li>
            <li><a href="javascript:void(0)" onclick="$('#panel-detail-2').slideToggle('slow');">Highlight 2</a></li>
            <li id="panel-detail-2"> The Cornell Fencing team finished in 2nd place overall last weekend.</li>
        </ul>
    </div>
    </div>

    </div>

    </div>

    <?php 
        if (isset($_SESSION['logged_user'])) { 
            print("<div class=add_comment>");
            print("<form action=index.php method=POST>");
            print("<textarea rows=4 cols=50 name=comment ></textarea>");
            print("<input type=submit name=add value=Comment>");
            print("</form> ");
            print("</div>");
        } else{
            print("<div class=add_comment>");
            print("<h3>Only a logged-in user can post a comment or reply.</h3>");
            print("<a href='admin.php'>Sign In</a> or <a href='register.php'>Create an Account</a>");
            print("</div>");
        }
    ?>



    <?php  
        if(isset($_POST['add'])){
            $comment = $_POST['comment'];
           
            if($comment){
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO comments VALUES (null, '$_SESSION[email]', '$_SESSION[logged_user]','$comment', '$date')";
                $mysqli->query($sql);
                // if ($mysqli->query($sql) === TRUE) {
                //     echo "New record created successfully";
                // } else {
                //     echo "Error: " . $sql . "<br>" . $mysqli->error;
                // }

            }else{
                echo "empty comment";
            }
           
        }
    ?>

    <?php  
        if(isset($_POST['add_reply'])){
            $reply = $_POST['reply'];
           
            if($reply){
                $comment_id = $_POST['hidden_id'];
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO reply VALUES (null, '$reply', '$date', '$_SESSION[email]', '$_SESSION[logged_user]')";
                $mysqli->query($sql);
                // if ($mysqli->query($sql) === TRUE) {
                //     echo "New record created successfully";
                // } else {
                //     echo "Error: " . $sql . "<br>" . $mysqli->error;
                // }

                $query1 = "SELECT id FROM reply WHERE time = '$date'";
                $reply_id = $mysqli->query($query1);
                if($reply_id->num_rows == 1){
                    while($id = $reply_id->fetch_row()){
                        $new_reply_id = $id[0];
                    }
                }
                
                $query = "INSERT INTO comment_reply VALUES ('$comment_id', '$new_reply_id')";
                $mysqli->query($query);

            }else{
                echo "empty reply";
            }
           
        }
    ?>

    <?php  
        $query = "SELECT * FROM comments";
        $result = $mysqli->query($query);
        $comment_count = 1;
        print("<div class=comment>");
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                $query_reply_for_comment = "SELECT * FROM reply, comment_reply 
                    WHERE reply.id = comment_reply.reply_id AND comment_reply.comment_id = $row[id]";
                $reply_for_this_comment = $mysqli->query($query_reply_for_comment);

                // if ($mysqli->query($query_reply_for_comment) === TRUE) {
                //     echo "New successfully";
                // } else {
                //     echo "Error: " . $query_reply_for_comment . "<br>" . $mysqli->error;
                // }


                print("<div class=detail_comment>");
                print("<h5>comment" . $comment_count . "</h5>");
                print("<h4>$row[username]</h4>");
                print("<h5>$row[content]</h5>");
                print("<h5>$row[time]</h5>");
                print("<div class=reply>");
                
                if ($reply_for_this_comment->num_rows > 0) {
                    while($row_reply = $reply_for_this_comment->fetch_assoc()){
                        print("<div class=detail_reply>");
                        print("<h4>$row_reply[username]</h4>");
                        print("<h5>$row_reply[content]</h5>");
                        print("<h5>$row_reply[time]</h5>");
                        print("</div>");
                    }
                }


                print("</div>");
                if (isset($_SESSION['logged_user'])) {
                    print("<input type=button value=reply name=reply id=$row[id] onclick=add_reply(this)>");
                }
                print("</div>");
                $comment_count++;
                //echo "id: " . $row["id"]. " - content: " . $row["content"] . "<br>";
            }
        }
        print("</div>");
    ?>


</div>
<?php 
    include 'footer.php'
?>
</body>
</html>