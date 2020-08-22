<?php

include("connection.php");

    if(isset($_POST['signup'])){

        $name = htmlentities(mysqli_real_escape_string($con, $_POST['name']));
        $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
        $pwd = htmlentities(mysqli_real_escape_string($con, $_POST['pwd']));
        $gender = htmlentities(mysqli_real_escape_string($con, $_POST['gender']));
        $forgot = htmlentities(mysqli_real_escape_string($con, $_POST['bf']));
        $rand = rand(1,2);

        if($name == ''){
            echo"<script>alert('We can not verify your name')</script>";
        }
        if(strlen($pwd)<8){
            echo "<script>alert('Password should be minimum 8 characters!')</script>";
            exit();
        }
        $check_mail = "SELECT * FROM users where mail = '$email'";
        $run_mail = mysqli_query($con, $check_mail);
        $check = mysqli_num_rows($run_mail);
        if($check==1){
            echo "<script>alert('Email already taken,Please use different')</script>";
            echo "<script>window.open('signup.php','_self')</script>";
            exit();
        }
        if($rand == 1){
            $profile_pic = "./pics/icons8-user-male-100.png";
        }
        else if($rand == 2){
            $profile_pic = "./pics/icons8-user-male-50.png";
        }
        $insert = "INSERT INTO users (name, pass, mail,profile, gender,forgot) VALUES ('$name','$pwd','$email','$profile_pic','$gender','$forgot')";
        $query = mysqli_query($con, $insert);

        if($query){
            echo "<script>alert('Hello $name, your account has been created..!')</script>";
            echo "<script>window.open('signin.php','_self')</script>";
        }
        else{
            echo "<script>alert('Something went wrong, try again!')</script>";
            echo "<script>window.open('signup.php','_self')</script>";
        }
    }

?>
