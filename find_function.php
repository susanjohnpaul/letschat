<?php

$con = mysqli_connect("localhost","root","","chat") or die("connection not established");
function search_user(){

    global $con;
    if(isset($_GET['search_btn'])){
        $search_query = htmlentities($_GET['search_query']);
        $get_user = "SELECT * FROM users WHERE name LIKE '%$search_query%' OR mail LIKE '%$search_query%' ";

    }else{
        $get_user = "SELECT * FROM users ORDER BY mail, name DESC LIMIT 5";

    }

    $run_user = mysqli_query($con, $get_user);
    while($row_user = mysqli_fetch_array($run_user)){
        $user_name = $row_user['name'];
        $profile = $row_user['profile'];
        $mail = $row_user['mail'];
        $gender = $row_user['gender'];
    
    echo "
       <div class='card'>
       <img src='./$profile'>
       <h1>$user_name</h1>
       <p class='title'>$mail</p>
       <p>$gender</p>
       <form method='post'>
       <p><button name='add'>Chat with $user_name</button></p>
       </form>
       
       </div><br><br>
    ";
    if(isset($_POST['add'])){
        echo "<script>window.open('./home.php?user_name=$user_name','_self')</script>";
    }
    }

}





?>

