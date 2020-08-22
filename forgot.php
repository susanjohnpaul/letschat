<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./css/signin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap-grid.min.css" integrity="sha512-pkOzvsY+X67Lfs6Yr/dbx+utt/C90MITnkwx8X5fyKkBorWHJLlR3TmgNJs83URAR0GdejZZnjZdgYjzL/mtcQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>
    <div class="signin">
    <form action="" method="post">
    <div class="form-header">
    <h2>Forgot Password</h2>
    <p>My Chat</p>
    </div>
    <div class="form-group">
    <label for="">
       Email
    </label>
    <input type="email" name="email" class="form-control" id="" autocomplete="off" required>
    </div>
    <div class="form-group">
    <label for="">
       BestFriends Name
    </label>
    <input type="text" name="bf" class="form-control" id="" autocomplete="off" placeholder="Someone like you..." required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-lg" name="submit">Submit</button>
    </div>
    </form>
    <div class="small text-center" style="color: #674288;">Back to signin <a href="signin.php">Come one..</a></div>
    </div>

    <?php
        session_start();
        include 'connection.php';

            if(isset($_POST['submit'])){
                $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
                $recovery = htmlentities(mysqli_real_escape_string($con, $_POST['bf']));

                $select = "SELECT * FROM users WHERE mail='$email' AND forgot='$recovery'";

                $query = mysqli_query($con, $select);
                $check = mysqli_num_rows($query);
                if($check==1){
                    $_SESSION['email']= $email;
                    echo"<script>window.open('create_pass.php','_self')</script>";
                }
                else{

                    echo "<script>alert('You forgot your bestfriend's name')</script>";
                    echo "<script>window.open('forgot.php','_self')</script>";
                }

            }

    ?>
</body>
</html>