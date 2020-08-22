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
    <title>Settings</title>
    <link rel="stylesheet" href="./css/find.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap-grid.min.css" integrity="sha512-pkOzvsY+X67Lfs6Yr/dbx+utt/C90MITnkwx8X5fyKkBorWHJLlR3TmgNJs83URAR0GdejZZnjZdgYjzL/mtcQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <?php
            $user = $_SESSION['email'];
            $get_user = "SELECT * FROM users where mail='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            $name = $row['name'];
            $id = $row['id'];
            $pass = $row['pass'];
            $email = $row['mail'];
            $profile = $row['profile'];
            $gender = $row['gender'];

?>
        <div class="col-sm-8">
            <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered table-hover">
                <tr style="text-align:center">
                    <td colspan="6" class="active"><h2>Change Account Settings</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Change your username
                    </td>
                    <td>
                        <input type="text" name="uname" class="form-control" required value="<?php
                        echo $name; ?>"/>
                    </td>
                </tr>
                <tr><td></td><td><a style="text-decoration:none; font-size:15px;" href="upload.php"><i class="fa fa-user"aria-hidden="true"></i>Change Profile<a class="btn"></a></td></tr>
              
            <tr>
                <td style="font-weight: bold;">Change your Email</td>
                 <td>
                     <input type="email" name="umail" class="form-control" required value="<?php echo $email;?>"/>
                 </td>
            </tr>

            <tr>
                <td style="font-weight:bold">Gender</td>
                <td>
                    <select name="ugender" class="form-control">
                        <option value=""><?php echo $gender;?></option>
                        <option >Male</option>
                        <option >Female</option>
                        <option >Others</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Forgot password</td>
                <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="myModal">Forgotten password</button>
                   <div class="modal fade" role="dialog" id="myModal">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                               </div>
                               <div class="modal-body">
                                   <form action="recovery.php?id=<?php echo $id;?>" method="post" id="f">
                                <strong>What is your best friends name?</strong>
                                <textarea name="content" class="form-control" cols="83" rows="4"placeholder="Someone.."></textarea><br>
                                <input type="submit" class="btn btn-default" name="sub" value="submit" style="width: 100px;"><br><br>
                                <pre>Answer the above question we will ask yu this question if you forget your<br>Password.</pre><br><br>
                                </form>
                                <?php
                                    if(isset($_POST['sub'])){
                                        $bfn =htmlentities($_POST['content']);
                                        if($bfn == ''){
                                            echo "<script>alert('please enter something.')</script>";
                                            echo "<script>window.open('account_settings.php','_self')</script>";
                                            exit();
                                        }
                                        else{
                                            $update = "UPDATE users SET forgotten='$bfn' WHERE mail = '$user'";

                                            $run = mysqli_query($con,$update);

                                            if($run){
                                                echo"<script>alert('Working..')</script>";
                                                echo "<script>window.open('account.php','_self')</script>";
                                            }else{
                                                echo "<script>alert('Error while updating Info.')</script>";
                                                echo "<script>window.open('account.php','_self')</script>";
                                            }
                                        }
                                    }

                                ?>
                               </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>

                           </div>
                       </div>
                   </div>
                
                </td>
            </tr>
            <tr>
                <td></td>
              <td>
                  <a href="password.php" class="btn btn-default" style="text-decoration: none;font-size:15px;">
                <i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</a>
              </td>
        </tr>
        <tr style="text-align:center">
          <td colspan="6">
              <input type="submit" value="Update" name="update" class="btn btn-info">
          </td>
    </tr>
            </table>

            </form>
                <?php
                    if(isset($_POST['update'])){
                        $name = htmlentities($_POST['uname']);
                        $email = htmlentities($_POST['umail']);
                        $gender = htmlentities($_POST['ugender']);

                        $update = "UPDATE users SET name = '$name', mail='$email', gender='$gender' WHERE mail='$user'";
                        $run = mysqli_query($con, $update);

                        if($run){
                            echo "<script>window.open('account.php','_self')</script>";
                        }
                    }



                ?>


        </div>
            <div class="cl-sm-2">

            </div>
    </div>
</body>
</html>
                <?php } ?>