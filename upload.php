<?php
session_start();
include 'connection.php';
include 'header.php';
if(!isset($_SESSION['email'])){
    header("location: signin.php");
}
else{
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Picture</title>
    <link rel="stylesheet" href="./css/upload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap-grid.min.css" integrity="sha512-pkOzvsY+X67Lfs6Yr/dbx+utt/C90MITnkwx8X5fyKkBorWHJLlR3TmgNJs83URAR0GdejZZnjZdgYjzL/mtcQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>
<?php

$user = $_SESSION['email'];
            $get_user = "SELECT * FROM users where mail='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);
            $name = $row['name'];
            $profile = $row['profile'];

       echo "
       <div class='card'>
       <img src='$profile'>
       <h1>$user_name</h1>
       <form method='post' enctype='multipart/form-data'>
       <label id='update_profile' ><i class='fa fa-circle-o' aria-hidden='true'></i>
       Select Profile
       <input type='file' name='uimg' size='600'></label>
       <button id='button_profile' name='update'>&nbsp&nbsp<i class='fa fa-heart' aria-hidden='true'></i>Update Profile</button>
       </form>
    </div><br><br>
       
       ";     
        if(isset($_POST['update'])){
            $img = $_FILES['uimg']['name'];
            $img_tmp = $_FILES['uimg']['tmp_name'];
            $target = './images/' . $img;
            $random = rand(1,100);
            if($img==''){
                echo "<script>alert('Please select a profile')</script>";
                echo "<script>window.open('upload.php','_self')</script>";
                exit();
            }else{

                move_uploaded_file($img_tmp, $target);
                $update = "UPDATE users SET profile='$target' WHERE mail='$user'";
                $run = mysqli_query($con,$update);

                if($run){
                    echo "<script>alert('Your Profile Updated..!')</script>";
                    echo "<script>window.open('upload.php','_self')</script>";
                }
            }
        }

?>




</body>
</html>
<?php } ?>    