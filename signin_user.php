<?php
session_start();

include("connection.php");

    if(isset($_POST['signin'])){

        $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
        $pwd = htmlentities(mysqli_real_escape_string($con, $_POST['pwd']));

        $select_user = "SELECT * FROM users WHERE mail ='$email' AND pass ='$pwd'";

        $query = mysqli_query($con, $select_user);
        $check_user = mysqli_num_rows($query);

        if($check_user == 1){
            $_SESSION['email']=$email;

            $update_msg = mysqli_query($con, "UPDATE users SET log_in='Online' WHERE mail ='$email'");

            $user = $_SESSION['email'];
            $get_user = "SELECT * FROM users WHERE mail='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            $user_name = $row['name'];

            echo "<script>window.open('home.php?user_name=$user_name','_self')</script>";
        }
        else{
            echo "
            
            <div class='alert alert-danger'>
            <strong>Check your email and password.</strong>
            </div>
            ";
        }
    }



?>
