<nav class="navbar-expand-sm bg-dark navbar navbar-dark" href="">
            <a href="" class="navbar-brand">
                <?php
                $user = $_SESSION['email'];
                $get_user = "SELECT * FROM users WHERE mail='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);

                $user_name = $row['name'];
                echo " <a class='navbar-brand' href='home.php?user_name=$user_name'>My Chat</a>";
                ?>
            </a>
            <ul class='navbar-nav'>
            <li><a style='color: white; text-decoration: none; font-size:20px;' href='account.php'>Setting</a></li>
            </ul>
        </nav><br>