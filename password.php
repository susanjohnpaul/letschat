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
<style>
    body{
        overflow-x: hidden;
    }
</style>
<body>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered table-hover">
                <tr style="text-align:center">
                    <td colspan="6" class="active"><h2>Change Password</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Current Password
                    </td>
                    <td>
                        <input type="password" name="current" class="form-control" id="mypass" required placeholder="Current Password"/>
                    </td>
                </tr>
                <tr>
                <td style="font-weight: bold;">New Password</td>
                 <td>
                 <input type="password" name="new" class="form-control" id="mypass" required placeholder="New Password"/>
                 </td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Confirm Password</td>
                 <td>
                 <input type="password" name="confirm" class="form-control" id="mypass" required placeholder="Confirm Password"/>
                 </td>
            </tr>
            <tr style="text-align: center;">
                <td colspan="6">
                    <input type="submit" value="Change" name="change" class="btn btn-info">
                </td>
        </tr>
            </table>
        </form>
        <?php
                if(isset($_POST['change'])){

                    $current = $_POST['current'];
                    $new = $_POST['new'];
                    $confirm = $_POST['confirm'];

                    $user = $_SESSION['email'];
                    $get_user = "SELECT * FROM users where mail='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row = mysqli_fetch_array($run_user);
        
                    $pass = $row['pass'];

                    if($current !== $pass){
                        echo "
                        <div class='alert alert-danger'>
                        <strong>Your Old password didn't match</strong>
                        </div>
                        ";
                    }
                    if($new !== $confirm){
                        echo "
                        <div class='alert alert-danger'>
                        <strong>Your new password didn't match with confirm password</strong>
                        </div>
                        ";
                    }
                    if($new <=9 AND $confirm <=9){
                        echo "
                        <div class='alert alert-danger'>
                        <strong>Use 9 or more characters</strong>
                        </div>
                        ";
                    }
                    if($new == $confirm AND $current == $pass){
                        $update = mysqli_query($con, "UPDATE users SET pass='$new' WHERE mail='$user'");
                        echo "
                        <div class='alert alert-danger'>
                        <strong>Password reset successfully.</strong>
                        </div>
                        ";
                    }
                }

        ?>
        </div>
        <div class="col-sm-2">
            
        </div>
    </div>


</body>
</html>
<?php } ?>