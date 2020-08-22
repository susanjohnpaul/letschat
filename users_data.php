<?php

$con = mysqli_connect("localhost","root","","chat");

    $user = "SELECT * FROM users";
    $run_user = mysqli_query($con, $user);
 while($row_user = mysqli_fetch_array($run_user)){

    $id = $row_user['id'];
    $name = $row_user['name'];
    $profile = $row_user['profile'];
    $login = $row_user['log_in'];

    echo "
    <li>
    <div class='chat-left-img'>
    <img src='$profile'>
    </div>
    <div class='chat-left-detail'>
    <p><a href='home.php?user_name=$name'>$name</a></p>";
    if($login == 'Online'){
        echo "<span><i class='fa fa-circle' aria-hidden='true'></i>Online</span>";
    }
    else{
        echo"<span><i class='fa fa-circle-o' aria-hidden='true'></i>Offline</span>";
    }    
 "
    </div>
    </li>
    ";
 }
?>