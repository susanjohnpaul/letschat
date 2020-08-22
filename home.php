<?php
session_start();
include 'connection.php';
if(!isset($_SESSION['email'])){
    header("location: signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap-grid.min.css" integrity="sha512-pkOzvsY+X67Lfs6Yr/dbx+utt/C90MITnkwx8X5fyKkBorWHJLlR3TmgNJs83URAR0GdejZZnjZdgYjzL/mtcQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>
<div class="container main-section">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
            <div class="input-group searchbox">
            <div class="input-group-btn text-center">
                <a href="find_friend.php"><button class="btn btn-default search-icon"name="search"type="submit">Add new user</button></a>
            </div>
        </div>
        <div class="left-chat">
            <ul>
                <?php include 'users_data.php'; ?>
            </ul>
        </div>
    </div>
        <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar" id="chatbo">
            <div class="row">
            <!-- Getting the user info who is logged in   -->
            <?php
                $user = $_SESSION['email'];
                $get_user = "SELECT * FROM users WHERE mail='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);

                $user_id = $row['id'];
                $user_name = $row['name'];

            ?>

            <!--  getting the user dataa on which user clicks    -->

            <?php
                if(isset($_GET['user_name']))
                {
                    global $con;
                    $get_username = $_GET['user_name'];
                    $get_user = "SELECT * FROM users WHERE name='$get_username'";

                    $run_user = mysqli_query($con, $get_user);
                    $row_user = mysqli_fetch_array($run_user);

                    $username = $row_user['name'];
                    $user_profile_image = $row_user['profile'];
                }

                $total_msg = "SELECT * FROM msg WHERE (sender_name='$user_name' AND receiver_name = '$username') OR (receiver_name='$user_name' AND sender_name = '$username')";
                 $run_msg = mysqli_query($con, $total_msg);
                 $total = mysqli_num_rows($run_msg);    
            ?>

              <div class="col-md-12 right-header">
                  <div class="right-header-img">
                      <img src=<?php echo "$user_profile_image";?>>
                  </div>
                  <div class="right-header-details">
                      <form method="POST">
                          <p><?php echo "$username"; ?></p>
                        <span><?php echo $total;?> Messages</span>&nbsp &nbsp
                        <button class="btn btn-danger" name="logout">Logout</button>
                        </form>
                        <?php
                            if(isset($_POST['logout'])){
                                $update_msg = mysqli_query($con, "UPDATE users SET log_in='Offline'
                                WHERE name='$user_name'");
                                header("location:logout.php");
                                exit();                            }

                        ?>
                  </div>
              </div>      

            </div>
 
            <div class="row">
                <div id="scrolling_to_bottom" class="col-md-12 right-header-contentchat">
                    <?php 
                    $update_msg = mysqli_query($con, "UPDATE msg SET msg_status='read' WHERE sender_name='$username' AND receiver_name=$user_name");

                    $sel_msg = "SELECT * FROM msg WHERE (sender_name='$user_name' AND receiver_name='$username')OR (receiver_name='$user_name' AND sender_name='$username') ORDER BY 1 ASC";
                    $run_msg = mysqli_query($con,$sel_msg);

                    while($row = mysqli_fetch_array($run_msg)){

                        $sender = $row['sender_name'];
                        $receiver = $row['receiver_name'];
                        $msg = $row['msg_content'];
                        $msg_date = $row['msg_date'];
                    
                    
                    ?>
                    <ul>
                       <?php

                        if($user_name == $sender AND $username == $receiver){

                            echo "
                            <li>
                            <div class='rightside-right-chat'>
                            <span>$user_name <small>$msg_date</small></span>
                            <br><br><p>$msg</p>
                            </div>
                            </li>
                            ";
                        }

                        else if($user_name == $receiver AND $username == $sender){

                            echo "
                            <li>
                            <div class='rightside-left-chat'>
                            <span>$username <small>$msg_date</small></span>
                            <br><br><p>$msg</p>
                            </div>
                            </li>
                            ";
                        }
                       ?>
                    </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 right-chat-textbox">
                    <form action="" method="post">
                        <input type="text" name="msg_content" id="" autocomplete="off" placeholder="Write a msg...">
                         <button class="btn" id="chat" value="load" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>    

<?php
  if(isset($_POST['submit'])){
      $msg = htmlentities($_POST['msg_content']);
      if($msg == ""){
          echo"
          <div class='alert alert-danger'>
          <strong>Message was unable to send.</strong>
          </div>
          ";
      }
     else if(strlen($msg) > 100){
        echo"
        <div class='alert alert-danger'>
        <strong>Message too long.</strong>
        </div>
        ";
    }
    else{
        $insert = "INSERT INTO msg(sender_name,receiver_name,msg_content,msg_status,msg_date) VALUES('$user_name','$username','$msg','unread',NOW())";
        $run_insert = mysqli_query($con, $insert);
        ?>
       <!-- <script type='text/javascript'>
          
           $('#chat').click(function(){
               $('#chatbo').load('home.php');
           });
        </script> -->
        <?php
       // echo "<script>window.open('home.php?user_name=$username','_self')</script>";
    }
  }
  ?>
  <script>
      $('#scrolling_to_bottom').animate({
          scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight},1000);
</script>

<script type="text/javascript">
$(document).ready(function(){
    var height = $(window).height();
    $('.left-chat').css('height',(height - 92)+ 'px');
    $('.right-header-contentchat').css('height',(height - 163)+ 'px');
});
</script>
</body>
</html>